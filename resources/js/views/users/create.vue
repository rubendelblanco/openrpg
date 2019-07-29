<template>
    <div>
         <h2>Crear usuario</h2>
         <b-alert variant="danger" :show="showErrors">
             <ul>
                <li v-for="error in errors" :key="error">
                    {{ error }}
                </li>
             </ul>
         </b-alert>
         <b-alert variant="success" :show="showSuccess">
             {{ success_message }}
         </b-alert>
         <form @submit="checkForm">
         <div class="row">
            <div class="col-md-4">
                Nombre: <input type="text" required="required" name="name" id="name" v-model="user.name">
            </div>
            <div class="col-md-4">
                E-mail: <input type="email" required="required" name="email" id="email" v-model="user.email">
            </div>
         </div>
         <change-password @password="changePassword" ></change-password>
         <button type="submit" class="btn btn-secondary">Crear usuario</button>
         </form>
    </div>
</template>

<script>
export default {
    data(){
        return {
            user: {},
            success_message: 'User created',
            submit_url:`/api/users/`,
            errors: [],
            showErrors: false,
            showSuccess: false
        }
    },
    methods:{
        changePassword(obj){
                this.user['password'] = obj.password;
                this.user['repeat_password'] = obj.repeat_password;
            },
        submitForm(e){
            e.preventDefault();
            axios.post(this.submit_url, this.user)
            .then(res => {
                if (res.status == 200){
                    this.showErrors = false;
                    this.showSuccess = true;
                }
            })
            .catch(err => {
                if (err.response.status == 422){
                    this.errors.push(err.response.data.errors);
                    this.showErrors=true;
                }
            });
        },
        checkForm: function(e){
            e.preventDefault();
            this.errors = [];

            if (this.user['password'] !== this.user['repeat_password']){
                this.errors.push('Los password no coinciden');
            }

            if (!this.errors.length) {
                this.showErrors=false;
                this.submitForm(e);
                return true;
            }
            else{
                this.showErrors=true;
            }
        }
    }
}
</script>
