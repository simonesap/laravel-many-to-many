<template>

    <div>

        <Header/>

        <main>
            <div class="container">
                <PostList/>
            </div>

            <!-- <Header/>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-body">
                            Sito in costruzione
                        </div>
                    </div>
                </div>
            </div> -->
        </main>
    </div>
</template>

<script>
import Header from './Header.vue';
import PostList from './posts/PostList.vue';

    export default {
        name: 'App',

        components: {
            Header,
            PostList,
        }
    }

</script>
