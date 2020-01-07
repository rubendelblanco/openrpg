<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spell_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('name');
            $table->text('list_type'); // config.rolemaster.list_types
            $table->text('description');
            $table->text('notes');
        });
        Schema::create('spells', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level');
            $table->text('name');
            $table->text('description');
            $table->text('list_name');
            $table->string('code', 5); // ins, nopp, comp
            $table->string('class', 5);
            $table->string('subclass', 5);
            $table->json('effect_area');
            $table->json('duration');
            $table->json('range');
            $table->text('notes')->nullable(true);
            $table->integer('list_id')->nullable(true);
            $table->foreign('list_id')->references('id')->on('spell_lists')->onDelete("set null");
        });
        // TODO: Constraint: pair(level, list_id)
        DB::statement("ALTER TABLE spells ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE spells SET searchtext = to_tsvector('spanish', name || '. ' || description || '. ' || list_name);");
        DB::statement("CREATE INDEX searchtext_gin ON spells USING GIN(searchtext)");
        DB::statement("
            CREATE TRIGGER ts_searchtext 
            BEFORE INSERT OR UPDATE ON spells
            FOR EACH ROW EXECUTE PROCEDURE 
                tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'name', 'description', 'list_name')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS tsvector_update_trigger ON posts");
        DB::statement("DROP INDEX IF EXISTS searchtext_gin");
        Schema::dropIfExists('spells');
        Schema::dropIfExists('spell_lists');
    }
}

