from django.db import models


class SpellList(models.Model):
    class Meta:
        managed = False
        db_table = "spell_lists"

    name = models.CharField(max_length=255, null=True)
    created_at = models.DateTimeField(null=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    list_type = models.CharField(max_length=255)
    description = models.TextField()

    def __str__(self):
        return f"{self.name} - {self.list_type} - {self.description[:30]}..."


class Spell(models.Model):
    class Meta:
        managed = False
        db_table = "spells"

    name = models.CharField(max_length=255)
    level = models.IntegerField()
    list_name = models.CharField(max_length=255)
    own_list = models.ForeignKey(
        to=SpellList, db_column="list_id", null=True, on_delete=models.SET_NULL
    )
    created_at = models.DateTimeField(null=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    description = models.TextField()
    code = models.CharField(
        choices=(
            ("std", "Estandar"),
            ("ins", "Instantaneo"),
            ("nopp", "No requiere PP"),
            ("comp", "Compuesto"),
        ),
        default="std",
        max_length=255,
    )
    class_name = models.CharField(
        db_column="class",
        max_length=30,
        choices=(
            ("E", "Elemental"),
            ("EB", "Elemental de bola"),
            ("ED", "Elemental dirigido"),
            ("F", "Fuerza"),
            ("P", "Pasivo"),
            ("U", "Utilidad"),
            ("I", "Informacion"),
        ),
        default="U",
    )
    subclass = models.CharField(
        max_length=255,
        choices=(("none", "-"), ("s", "subconsciente"), ("m", "mental"),),
        default="none",
    )
    effect_area = models.TextField(
        help_text="""
        formatted as json as string:

            interface {
                code string,
                amount number,
                unit string 
            }

            'SELF' => ['code' => 'SELF', 'display' => 'A uno mismo'],
            'AREA' => ['code' => 'AREA', 'display' => 'A un area determinada (1 hierba, 1 extremidad)'],
            'TARGET' => ['code' => 'SELF', 'display' => 'A objetivo(s)'],
            'TARGET_LVL' => ['code' => 'SELF', 'display' => 'A objetivo(s) / nivel'],
            'DIST' => ['code' => 'DIST', 'display' => 'Distancia en metros (radio)'],
            'DIST_LVL' => ['code' => 'DIST_LVL', 'display' => 'Distancia en metros/nivel (radio)'],
            'VARY' => ['code' => 'VARY', 'display' => 'Varia en funcion de las circunstancias'],
            'NONE' => ['code' => 'NONE', 'display' => 'Sin area de efecto']
    """
    )
    duration = models.TextField(
        help_text="""
        formatted as json as string:

            'TIME' => ['code' => 'TIME', 'display' => 'Duration determinada'],
            'C' => ['code' => 'C', 'display' => 'Se requiere concentracion'],
            'DURATION' => ['code' => 'DURATION', 'display' => 'Se requiere concentracion, con limite de tiempo'],
            'P' => ['code' => 'P', 'display' => 'Permanente e inmediato'],
            'VARY' => ['code' => 'VARY', 'display' => 'Varia en funcion del hechizo'],
            'INS' => ['code' => 'INS', 'display' => 'Sin duracion, inmediato'],
            'TIME_LVL' => ['code' => 'TIME_LVL', 'display' => 'Tiempo/asaltos multiplicados por el nivel del lanzador'],
            'TIME_FAIL' => ['code' => 'TIME_FAIL', 'display' => 'unidad de tiempo / puntos. tiempo = ((TR - RMF) / puntos)'],
    """
    )
    range_data = models.TextField(
        "Range",
        db_column="range",
        max_length=255,
        help_text="""
        formatted as json as string: 
            'SELF' => ['code' => 'SELF', 'display' => 'A uno mismo'],
            'CON' => ['code' => 'CON', 'display' => 'Se requiere contacto'],
            'DIST' => ['code' => 'DIST', 'display' => 'El lanzador no puede estar mas lejos de la distancia del area del efecto deseada'],
            'DIST_LVL' => ['code' => 'DIST_LVL', 'display' => 'La distancia del area de efecto no puede ser mayor de la distancia por el nivel del lanzador'],
            'ILI' => ['code' => 'ILI', 'display' => 'Sin limitacion'],
            'VARY' => ['code' => 'VARY', 'display' => 'La distancia varia en funcion de algun aspecto del feitizo'],
    """,
    )
    notes = models.TextField()

    def __str__(self):
        return f"{self.level} - {self.name} - {self.list_name} - {self.description[:30]}..."
