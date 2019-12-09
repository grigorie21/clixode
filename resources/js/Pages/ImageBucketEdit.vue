<template>
    <div>
        Image buckets edit

        {{$route.params.id}}

        <b-card no-body>
            <b-tabs card>
                <b-tab title="Bucket" active>
                    <b-form @submit.prevent="submit()">
                        <b-form-group label="ID">
                            <b-form-input v-model="model.id" type="text" disabled></b-form-input>
                        </b-form-group>

                        <b-form-group label="Title">
                            <b-form-input v-model="model.title" placeholder="Enter bucket title"></b-form-input>
                        </b-form-group>

                        <b-form-group label="Created">
                            <b-form-input v-model="model.created_at" type="text" disabled></b-form-input>
                        </b-form-group>

                        <b-form-group label="Updated">
                            <b-form-input v-model="model.updated_at" type="text" disabled></b-form-input>
                        </b-form-group>

                        <b-button type="submit" variant="success">Save/Update</b-button>
                    </b-form>
                </b-tab>
                <b-tab title="Images">
                    <b-card-text>{{model.images}}</b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    import routes from "../routes";

    export default {
        name: "ImageBucketEdit",
        data() {
            return {
                model: {},
                fields: [
                    {key: 'id', label: 'ID'},
                    {key: 'title', label: 'Title'},
                    {key: 'created_at', label: 'Created'},
                    {key: 'updated_at', label: 'Updated'},
                    {key: 'actions', label: 'Actions'},
                ],
                items: []
            }
        },
        async mounted() {
            let response = await fetch('/api/bucket-image/'+ this.$route.params.id);

            if (response.ok) {
                let json = await response.json();
                console.log(json);

                this.model = json.data;
            } else {

            }
        },
        methods: {
            async getData() {

            },
            submit() {
                alert('submit form');
            }
        }
    }
</script>

<style scoped>

</style>
