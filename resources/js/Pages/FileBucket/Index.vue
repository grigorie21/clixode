<template>
    <div>
        File buckets
        <div class="overflow-auto">
            <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                aria-controls="my-table"
               @change="getData">
            </b-pagination>
            <p class="mt-3">Current Page: {{ currentPage }}</p>
            <b-table :items="items" :fields="fields" :busy="false">
                <template v-slot:cell(actions)="v">
                    <router-link :to="{name: 'file-buckets.edit', params: {id: v.item.id}}">[Edit]</router-link>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                perPage: 0,
                currentPage: 1,
                rows: 0,
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
            let response = await fetch('/api/bucket-file');

            if (response.ok) {
                let json = await response.json();
                console.log(json);

                this.items = json.data;
                this.rows = json.meta.total;
                this.perPage = json.meta.per_page;

            } else {

            }
        },
        methods: {
            async getData(page) {
                let response = await fetch('/api/bucket-file?page='+page);

                if (response.ok) {
                    let json = await response.json();
                    console.log(json);

                    this.items = json.data;
                    this.rows = json.meta.total;
                    this.perPage = json.meta.per_page;

                } else {

                }
            },
        },
    }
</script>
