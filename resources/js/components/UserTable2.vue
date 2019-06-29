<template>
    <div>
        <div id="main-wrapper" class="container">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <b-table busy.sync="true" show-empty striped hover responsive :items="users" :fields="fields" :filter="filter" :current-page="currentPage" :per-page="perPage" @refreshed="verfris">
                        <template slot="actions" slot-scope="data">
                            <a class="icon" href="#"><i class="fas fa-eye"></i></a>
                            <a class="icon" href="#"><i class="fas fa-pencil-alt"></i></a>
                            <a class="icon"><i class="fas fa-trash"></i></a>
                        </template>
                    </b-table>
                    <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0 pagination-sm" />
                </div>

            </div>

        </div>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                users: [],
                filter: null,
                currentPage: 1,
                perPage: 10,
                totalRows: null,
                selectedID: null,
                fields: [
                    {
                        key: 'id',
                        sortable: true
                    },
                    {
                        key: 'name',
                        sortable: true
                    },
                    {
                        key: 'email',
                        sortable: true
                    },
                    {
                        key: 'actions'
                    }

                ],
            }
        },
        mounted() {
            this.getResults();
        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(ctx, callback) {
                axios.get('/api/users')

                    .then(response => {
                        this.users = response.data;
                        this.totalRows = response.data.length;
                        return this.users;
                    });
            }
        },

    }
</script>