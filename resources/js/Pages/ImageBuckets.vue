<template>
    <div>
        Image buckets

        <b-table :items="items" :fields="fields" :busy="false">
            <template v-slot:cell(actions)="v">
                <router-link :to="{name: 'image-buckets.edit', params: {id: v.item.id}}">[Edit]</router-link>
                <a href="#">[Delete]</a>
            </template>

            <template v-slot:table-busy>
                <div class="text-center text-danger my-2">
                    <b-spinner class="align-middle"></b-spinner>
                    <strong>Loading...</strong>
                </div>
            </template>
        </b-table>
    </div>
</template>

<script>
    export default {
        name: "ImageBuckets",
        data() {
            return {
                fields: [
                    {key: 'id', label: 'ID'},
                    {key: 'title', label: 'Title'},
                    {key: 'created_at', label: 'Created'},
                    {key: 'updated_at', label: 'Updated'},
                    {key: 'actions', label: 'Actions'},
                ],
                items: [
                    {id: 'John', title: 'Male', actions: 42},
                    {id: 'Jane', title: 'Female', actions: 36},
                    {id: 'Rubin', title: 'male', actions: 73},
                    {id: 'Shirley', title: 'female', actions: 62}
                ]
            }
        },
        async mounted() {
            let response = await fetch('/api/bucket-image');

            if (response.ok) {
                let json = await response.json();
                console.log(json);

                this.items = json.data;
            } else {

            }
        },
        methods: {
            async getData() {

            },
        }
    }
</script>

<style scoped>

</style>
