<template>
    <div>
        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
        <success-message :success="success" :success_message="success_message" v-if="success"></success-message>
        <div class="panel-body">
            <div class="container-fluid">
                <form @submit="submitForm">
                    <div class="row my-1">
                        <b-form-group
                            label="Personaje:"
                            label-for="character"
                            description="Personaje al que se le suman los puntos de experiencia"
                        >
                            <b-form-select id="character" v-model="selected.character" :options="options" required></b-form-select>
                        </b-form-group>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-2"><label for="maneuver">Maniobras</label></div>
                        <div class="col-sm-4">
                            <b-form-select id="maneuver" v-model="selected.maneuver" :options="maneuver_options" @change="calculateXP(`maneuver?man=${selected.maneuver}`, 'totalManeuver')"></b-form-select>
                        </div>
                        <div class="col-sm-2" ref="totalManeuver"></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-2">Por feitizo</div>
                        <div class="col-sm-2">Nivel hechicero</div>
                        <div class="col-sm-2">
                            <b-form-input v-model="selected.casterLevel" type="number"
                                                                     ref="casterLevel" min="1" @change="calculateXP(`spell?caster=${selected.casterLevel}&spell=${selected.spellLevel}`, 'totalSpell')"></b-form-input>
                        </div>
                        <div class="col-sm-2">Nivel hechizo</div>
                        <div class="col-sm-2">
                            <b-form-input v-model="selected.spellLevel" type="number"
                                                                     ref="spellLevel" min="1" @change="calculateXP(`spell?caster=${selected.casterLevel}&spell=${selected.spellLevel}`, 'totalSpell')"></b-form-input>
                        </div>
                        <div class="col-sm-2" ref="totalSpell"></div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-2">Crítico</div>
                        <div class="col-sm-2">Nivel del blanco</div>
                        <div class="col-sm-2">
                            <b-form-input v-model="selected.criticalTargetLevel" type="number"
                                          ref="criticalTargetLevel" min="1" @change="calculateXP(`critical?crit=${selected.critical}&level=${selected.criticalTargetLevel}`, 'totalCritical')"></b-form-input>
                        </div>
                        <div class="col-sm-2">Crítico</div>
                        <div class="col-sm-2">
                            <b-form-select v-model="selected.critical" :options = "critical_options"
                                          ref="critical" @change="calculateXP(`critical?crit=${selected.critical}&level=${selected.criticalTargetLevel}`, 'totalCritical')"></b-form-select>
                        </div>
                        <div class="col-sm-2" ref="totalCritical"></div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-2">Pieza</div>
                        <div class="col-sm-2">Nivel atacante</div>
                        <div class="col-sm-2">
                            <b-form-input v-model="selected.attackerLevel" type="number"
                                      ref="attackerLevel" min="1" @change="calculateXP(`kill?attack=${selected.attackerLevel}&def=${selected.defenderLevel}`, 'totalKill')"></b-form-input>
                        </div>
                        <div class="col-sm-2">Nivel defensor</div>
                        <div class="col-sm-2">
                            <b-form-input v-model="selected.defenderLevel" type="number"
                                      ref="defenderLevel" min="1" @change="calculateXP(`kill?attack=${selected.attackerLevel}&def=${selected.defenderLevel}`, 'totalKill')"></b-form-input>
                        </div>
                        <div class="col-sm-2" ref="totalKill"></div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-2">Bonus enemigo</div>
                        <div class="col-sm-2">Nivel atacante</div>
                        <div class="col-sm-2">
                            <b-form-input v-model="selected.attackerLevelBonus" type="number"
                                          ref="attackerLevelBonus" min="1" @change="calculateXP(`bonus?level=${selected.attackerLevelBonus}&code=${selected.bonusExp}`, 'totalBonus')"></b-form-input>
                        </div>
                        <div class="col-sm-2">Código bonus</div>
                        <div class="col-sm-2">
                            <b-form-select v-model="selected.bonusExp" :options = "bonus_options"
                                           ref="bonus" @change="calculateXP(`bonus?level=${selected.attackerLevelBonus}&code=${selected.bonusExp}`, 'totalBonus')"></b-form-select>
                        </div>
                        <div class="col-sm-2" ref="totalBonus"></div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-3">Puntos de vida, poder y viaje</div>
                        <div class="col-sm-2">
                            <b-form-input ref="travel" type="number" min="0" v-model="selected.travel" @change="calculateXP(`travel?base=${selected.travel}`, 'totalTravel')"></b-form-input>
                        </div>
                        <div class="col-sm-2" ref="totalTravel"></div>
                    </div>
                    <div class="row my-1">
                        <span>Total: </span><b-form-input v-model="selected.totalXP" min="0" type="number" class="totalXP" ref="totalXP"></b-form-input>
                    </div>
                    <div class="row my-1">
                        <b-button type="submit">Sumar</b-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                experiencesModel: {
                },
                selected: {
                    critical: 'a',
                    criticalTargetLevel: 1,
                    character:null,
                    casterLevel:1,
                    spellLevel:1,
                    attackerLevel: 1,
                    defenderLevel: 1,
                    bonusExp: 'a',
                    attackerLevelBonus: 1,
                    maneuver: 'n',
                    travel: 0,
                    xp: {
                        totalManeuver: 0,
                        totalSpell: 0,
                        totalCritical: 0,
                        totalKill: 0,
                        totalBonus: 0,
                        totalTravel: 0
                    },
                    totalXP: 0
                },
                success_message: "",
                submit_url: `api/characters/`,
                errors: [],
                success: false,
                validationErrors: "",
                options: [],
                maneuver_options:{
                    'mf':'Muy facil',
                    'f':'Facil',
                    'n':'Normal',
                    'd':'Dificil',
                    'md':'Muy difícil',
                    'ed':'Extremadamente difícil',
                    'lc':'Locura completa',
                    'ab':'Absurdo'
                },
                critical_options:{
                    'a':'A',
                    'b':'B',
                    'c':'C',
                    'd':'D',
                    'e':'E'
                },
                bonus_options:{
                    'a':'A',
                    'b':'B',
                    'c':'C',
                    'd':'D',
                    'e':'E',
                    'f':'F',
                    'g':'G',
                    'h':'H',
                    'i':'I',
                    'j':'J',
                    'k':'K',
                    'l':'L'
                }
            };
        },
        mounted() {
            axios
                .get(`/api/characters/`)
                .then(res => {
                    const characters = res.data;
                    this.experiencesModel = new Map(characters.map(c => [c.id,c.experience]));
                    this.options = characters.map(c => ({value:c.id, text: `${c.name} - ${c.experience} (Niv: ${c.level})`}));
                })
                .catch(err => {
                    this.errors.push(err);
                });
        },
        methods: {
            submitForm(e) {
                e.preventDefault();
                axios
                    .patch(this.submit_url+this.selected.character, this.sumXp())
                    .then(res => {
                        if (res.status === 200) {
                            this.validationErrors = "";
                            this.success = true;
                            this.success_message = res.data.message;
                        }
                    })
                    .catch(err => {
                        if (err.response.status === 422) {
                            this.validationErrors = err.response.data.errors;
                        }
                    });
            },
            calculateXP(endpoint,ref){
                axios
                    .get(`api/xp/${endpoint}`)
                    .then(res => {
                        this.$refs[ref].innerText = res.data.message;
                        this.selected.xp[ref] = res.data.message;
                        this.selected.totalXP = this.recalculateXP();
                    })
            },
            sumXp(){
                const selectedCharacterCurrentXP = this.experiencesModel.get(this.selected.character);
                return {'experience' : parseInt(selectedCharacterCurrentXP)+parseInt(this.$refs.totalXP.innerText)};
            },
            recalculateXP(){
                let sumXPFields = 0;
                const selectedXPKeys = Object.entries(this.selected.xp);

                for (const [key,xp] of selectedXPKeys) {
                    sumXPFields += parseInt(xp);
                }

                return sumXPFields;
            }
        }
    };
</script>
<style>
    .totalXP{
        padding-left:1%;
        font-weight: bold;
    }
</style>
