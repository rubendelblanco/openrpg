from django.contrib import admin
from . import models


class AdminSpellList(admin.ModelAdmin):
    search_fields = ("name", "description")


class AdminSpell(admin.ModelAdmin):
    search_fields = ("name", "list_name", "description", "notes")

    def save_model(self, request, obj, form, change):
        obj.effect_area = request.POST.get("effect_area").replace("'", '"')
        obj.duration = request.POST.get("duration").replace("'", '"')
        obj.range_data = request.POST.get("range_data").replace("'", '"')
        obj.save()


admin.site.register(models.SpellList, AdminSpellList)
admin.site.register(models.Spell, AdminSpell)
