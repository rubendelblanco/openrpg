<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <label for="password">Password</label>
            </div>
            <div class="col-md-6">
                <input type="password" name="password" @input="updatePass()" v-model="form.password" ref="password" id="password">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
               <label for="repeat_password">Repite password</label>
            </div>
            <div class="col-md-6">
                <input type="password" name="repeat_password" @input="updatePass()" v-model="form.repeat_password" ref="repeat_password" id="repeat_password">
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                form: {}
            }
        },
        methods:{
            updatePass(){
                this.$emit('password',this.form)
            }
        }
    }
</script>
