
<script>
export default {
    data(){
        return{
            views: 0,
            blogs: [],
            showItem: false
        }
    },
    methods:{
        updateCounter(number){
            this.views += number;
        },
        changeShowItem(){
            this.showItem = !this.showItem;
        }
    },
    created(){
        // call the server to get views of this blog post..
            this.views = 100;

        // get the blog post
        let posts = [
                {title: 'This is first title', post: 'this is the blog post',id : 1},
                {title: 'This is second title',post: 'this is the blog post',id : 2},
                {title: 'This is third title', post: 'this is the blog post',id : 3},
                {title: 'This is fourth title',post: 'this is the blog post',id : 4},
                {title: 'This is fifth title', post: 'this is the blog post',id : 5},
        ];
        // setState blogs = posts
        this.blogs = posts;
    }
}
</script>

<template>
    <div>
        <h1>the number is : {{views}} </h1>
        <!-- @click == onClick -->
        <button @click="updateCounter(1)">Increase</button>
        <button @click="updateCounter(-1)">Decrease</button>

            <div >
                <table class="table">
                    <tr>
                    <thead>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Post</th>
                            <th>Action</th>
                    </thead>
                    </tr>
                    <tr>
                        <!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
                        <tbody v-for="(blog, i) in blogs" :key="i" v-if="blogs.length > 1">
                                <tr>
                                    <td>{{blog.id}}</td>
                                    <td>{{blog.title}}</td>
                                    <td>{{blog.post}}</td>
                                    <td><a href="#" class="btn btn-primary">test</a></td>
                                </tr>
                        </tbody>
                    </tr>
                </table>
        </div>

            <div>
                <h1 v-if="showItem">Show item if showitem is true</h1>
                
                <h1 v-else>Show item if showitem is false</h1>
            </div>

            <button @click="showItem = !showItem"> Change showItem</button>
    </div>
</template>