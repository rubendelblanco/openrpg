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
                            <b-form-select id="character" @change="fillFormWithCharLevel()" v-model="selected.character" :options="options" required></b-form-select>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Maniobra"
                            label-for="maneuver"
                            description="Dificultad de la maniobra"
                        >
                            <b-form inline>
                                <b-form-select id="maneuver" v-model="selected.maneuver" :options="maneuver_options"
                                               @change="calculateXP(`maneuver?man=${selected.maneuver}`, 'totalManeuver')">

                                </b-form-select>
                                <b-input-group prepend="Total">
                                    <b-form-input type="number"
                                                  v-model="selected.xp.totalManeuver"
                                                  ref="totalManeuver" @change="recalculateXP()"></b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Hechizos"
                            description="Puntos por lanzar hechizos">
                            <b-form inline>
                                <b-input-group prepend="Nivel hechicero / nivel hechizo">
                                    <b-form-input v-model="selected.casterLevel" type="number"
                                                                         ref="casterLevel" min="1" @change="calculateXP(`spell?caster=${selected.casterLevel}&spell=${selected.spellLevel}`, 'totalSpell')"></b-form-input>
                                    <b-form-input v-model="selected.spellLevel" type="number"
                                                                         ref="spellLevel" min="0" @change="calculateXP(`spell?caster=${selected.casterLevel}&spell=${selected.spellLevel}`, 'totalSpell')"></b-form-input>
                                </b-input-group>
                                <b-input-group prepend="Total">
                                    <b-form-input
                                        type="number"
                                        v-model="selected.xp.totalSpell"
                                        ref="totalSpell" @change="recalculateXP()"></b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Críticos"
                            description="Por infligir crítico a un adversario">
                            <b-form inline>
                                <b-input-group prepend="Nivel del blanco / nivel del crítico">
                                    <b-form-input v-model="selected.criticalTargetLevel" type="number"
                                                  ref="criticalTargetLevel" min="1" @change="calculateXP(`critical?crit=${selected.critical}&level=${selected.criticalTargetLevel}`, 'totalCritical')"></b-form-input>
                                    <b-form-select v-model="selected.critical" :options = "critical_options"
                                                   ref="critical" @change="calculateXP(`critical?crit=${selected.critical}&level=${selected.criticalTargetLevel}`, 'totalCritical')"></b-form-select>
                                </b-input-group>
                                <b-input-group prepend="Total">
                                    <b-form-input
                                        type="number"
                                        v-model="selected.xp.totalCritical"
                                        ref="totalCritical" @change="recalculateXP()">
                                    </b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Pieza"
                            description="Por 'vencer' a un adversario">
                            <b-form inline>
                                <b-input-group prepend="Nivel del atacante / nivel del defensor">
                                    <b-form-input v-model="selected.attackerLevel" type="number"
                                                  ref="attackerLevel" min="0" @change="calculateXP(`kill?attack=${selected.attackerLevel}&def=${selected.defenderLevel}`, 'totalKill')"></b-form-input>
                                    <b-form-input v-model="selected.defenderLevel" type="number"
                                                  ref="defenderLevel" min="1" @change="calculateXP(`kill?attack=${selected.attackerLevel}&def=${selected.defenderLevel}`, 'totalKill')"></b-form-input>
                                </b-input-group>
                                <b-input-group prepend="Total">
                                    <b-form-input type="number" v-model="selected.xp.totalKill"
                                                  ref="totalKill" @change="recalculateXP()">
                                    </b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Bonus pieza"
                            description="Bonus por 'vencer' a un adversario (Manual monstruos y criaturas)">
                            <b-form inline>
                                <b-input-group prepend="Nivel del atacante / código bonus">
                                    <b-form-input v-model="selected.attackerLevelBonus" type="number"
                                                  ref="attackerLevelBonus" min="1" @change="calculateXP(`bonus?level=${selected.attackerLevelBonus}&code=${selected.bonusExp}`, 'totalBonus')"></b-form-input>
                                    <b-form-select v-model="selected.bonusExp" :options = "bonus_options"
                                                   ref="bonus" @change="calculateXP(`bonus?level=${selected.attackerLevelBonus}&code=${selected.bonusExp}`, 'totalBonus')"></b-form-select>
                                </b-input-group>
                                <b-input-group prepend="Total">
                                    <b-form-input type="number" v-model="selected.xp.totalBonus"
                                                  ref="totalBonus" @change="recalculateXP()"></b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Puntos de vida, poder y viaje"
                            description="Por PV infligidos o sufridos, por PP gastados y por km de viaje">
                            <b-form inline>
                                <b-input-group prepend="Total">
                                    <b-form-input type="number" v-model="selected.xp.totalTravel" @change="recalculateXP()">
                                    </b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Puntos por ideas/aventura"
                            description="Por ideas u objetivos cumplidos en la aventura">
                            <b-form inline>
                                <b-input-group prepend="Total">
                                    <b-form-input type="number" v-model="selected.xp.totalIdea"
                                                  ref="totalIdea" @change="recalculateXP()">
                                    </b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
                    </div>

                    <div class="row my-1">
                        <b-form-group
                            label="Suma total" class="totalXP-label">
                            <b-form inline>
                                <b-input-group prepend="Total">
                                    <b-form-input v-model="selected.totalXP" type="number"
                                                  class="totalXP" ref="totalXP"></b-form-input>
                                </b-input-group>
                            </b-form>
                        </b-form-group>
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
                    critical: 'null',
                    criticalTargetLevel: 1,
                    character:null,
                    casterLevel:1,
                    spellLevel:0,
                    attackerLevel: 0,
                    defenderLevel: 1,
                    bonusExp: 'null',
                    attackerLevelBonus: 0,
                    maneuver: 'ru',
                    travel: 0,
                    xp: {
                        totalManeuver: 0,
                        totalSpell: 0,
                        totalCritical: 0,
                        totalKill: 0,
                        totalBonus: 0,
                        totalTravel: 0,
                        totalIdea: 0
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
                    'ru':'Rutina',
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
                    'null':'--',
                    'a':'A',
                    'b':'B',
                    'c':'C',
                    'd':'D',
                    'e':'E'
                },
                bonus_options:{
                    'null':'--',
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
                    this.experiencesModel = new Map(characters.map(c => [c.id,{'experience':c.experience,'level':c.level}]));
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
                            e.target.reset();
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
                        this.selected.xp[ref] = res.data.message;
                        this.recalculateXP();
                    })
                    .catch(err => {
                        this.selected.xp[ref] = 0;
                        this.recalculateXP();
                    });
            },
            sumXp(){
                const selectedCharacterCurrentXP = this.experiencesModel.get(this.selected.character);
                return {'experience' : parseInt(selectedCharacterCurrentXP.experience)+parseInt(this.selected.totalXP)};
            },
            recalculateXP(){
                let sumXPFields = 0;
                const selectedXPKeys = Object.entries(this.selected.xp);

                for (const [key,xp] of selectedXPKeys) {
                    sumXPFields += parseInt(xp);
                }

                this.selected.totalXP = sumXPFields;
            },
            fillFormWithCharLevel(){
                const selectedCharacter = this.experiencesModel.get(this.selected.character);
                let fields = ['casterLevel','attackerLevel','attackerLevelBonus'];

                for ( let i = 0;i< fields.length; i++){
                    this.selected[fields[i]] = selectedCharacter.level;
                }
            }
        }
    };
</script>
<style>
    .totalXP{
        font-weight: bold;
    }
    .totalXP-label{
        font-weight: bold;
        color: #2fa360;
    }
</style>
