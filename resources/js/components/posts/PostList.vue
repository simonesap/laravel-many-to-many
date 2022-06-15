<template>

    <div>
        <Loader v-if="isLoading" />

        <div v-if="posts.length">
            <div class="card text-center" v-for="post in posts" :key="post.id">
                <div class="card-header">
                    {{post.title}} - Category: {{post.category.label}}
                </div>
                <div class="card-body">
                    <p class="card-title">
                        <span v-for="tag in post.tags" :key="tag.id" class="badge" :style="`background-color: ${tag.color}`">
                            {{tag.label}}
                        </span>
                    </p>
                    <p class="card-text">{{post.content}}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
        </div>
        <p v-else>Non ci sono post</p>
    </div>

</template>

<script>
import axios from 'axios';
import Loader from '../Loader.vue';

    export default {
        name: 'PostList',

        components: {
            Loader,
        },

        data() {
            return{
                posts: [],
                isLoading: true,
            }

        },

        methods: {
                getPosts(){
                    axios.get('http://127.0.0.1:8000/api/posts')
                    .then( (res) => {
                        // console.log(res.data)
                        this.posts = res.data.posts;
                        // this.isLoading = false;
                    }).then( ()=>{
                        // console.log('terminato il caricamento dei posts')
                        this.isLoading = false;
                    } )

            }
        },

        mounted() {
            this.getPosts();
        }

    }

</script>

<style scoped>

</style>
