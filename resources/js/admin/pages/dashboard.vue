<template>
   
        <div>
           <div class="content" >
               <div class="container-fluid">
                   <div style="display:flex;flex-direction:row;justify-content:space-around">
                        <div class="card" style="width: 18rem;">
                            <router-link to="/user">
                            <div class="card-body">
                                <h5 class="card-title">USERS</h5>
                                <div class="_1adminOverveiw_card_right">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                </div>
                            </div>
                            </router-link>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <router-link to="/comments">
                            <div class="card-body">
                                <h5 class="card-title">COMMENTS</h5>
                                 <div class="_1adminOverveiw_card_right">
								<i class="fa fa-comments" aria-hidden="true"></i>
							    </div>
                            </div>
                            </router-link>
                            </div>
                         <div class="card" style="width: 18rem;">
                           <router-link to="/albums">
                                <div class="card-body">
                                        <h5 class="card-title">ALBUMS</h5>
                                        <div class="_1adminOverveiw_card_right">
                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                        </div>
                                </div>
                           </router-link>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <router-link to="/photo">
                                    <div class="card-body">
                                        <h5 class="card-title">PHOTOS</h5>
                                            <div class="_1adminOverveiw_card_right">
                                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            </div>
                                    
                                    </div>
                            </router-link>
                        </div>
                          <div class="card" style="width: 18rem;">
                              <router-link to="/todos">
                                    <div class="card-body">
                                        <h5 class="card-title">TODOS</h5>
                                    <div class="_1adminOverveiw_card_right">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </div>
                                    
                                    </div>
                              </router-link>
                        </div>
                       
           </div>
           
            <div class="container-main-add" style="margin-top:20px;"  v-if="active.dashboard">
                <div class="container-main-contentBox" >
                     <div class="small-box lms-color-white "> 
                        <div class="col-sm-12">
                            
                        <div class="alert-success alert" role="alert"
                            v-if="success_message !== null"
                        >
                            {{ success_message }} 
                        </div>

                        <div class="alert-danger alert" role="alert"
                            v-if="danger_message !== null"
                        >
                            {{ danger_message }} 
                            </div>
                            <p class="_title0">POSTS  <Button @click="addModal = true"><Icon type="md-add" /> Add post</Button> </p>
                            <div class="space">
                           <Input v-model="keyword" placeholder="Search post" />
                           </div>
                        <table id="datatable" class="table table-striped table-bordered lms-font-color-brown lms-font-family-roboto-slab" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>USER ID</th>   
                                    <th>TITLE</th>
                                    <th>BODY</th>
                                    <th>ACTION</th>              

                                </tr>
                            </thead>

                    
                         <tbody v-if="results !==null">
                             
                    	<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
                            <tr v-for="(post, i) in filterPost" :key="i" v-if="posts.length">
                                <td>{{post.id}}</td>
                                <td class="_table_name">{{post.userId}}</td>
                                <td>{{ post.title }}</td>
                                <td> {{ post.body }}</td>
                              
                                <td>
                                <div class="btn-group">
                                    <!-- <button class="btn btn-secondary btn-sm" title="View User Logs" @click="viewUserLogs(user)"><i class="fas fa-list-alt"></i></button> -->
                                    <button class="btn btn-sm btn-warning" @click="showEditModal(post, i)"><i class="fa fa-edit"></i></button>
                                     <button class="btn btn-sm btn-danger" @click="showDeletingModal(post, i)"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                            </tr>
                    </tbody>
                </table>
                 <PaginatorDetails
                    v-if="results !==null"
                    v-bind:results="results"
                        ></PaginatorDetails>
                <Paginator
                    v-if="results !==null"
                    v-bind:results="results"
                    v-on:get-page="getPage"
                ></Paginator>
                
            </div>
        </div>

    </div>


    </div>

        </div>

    </div>
         <Modal
                    v-model="addModal"
                    title="Add Post"
                    :mask-closable="false"
                    :closable="false"
                    >
                    <Input v-model="data.title" placeholder="Add Post name" />
                    <div class="space">
                    <Input v-model="data.body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" ></Input>
                    </div>

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" @click="addPost" 
                                    :disabled="isAdding" 
                                    :loading="isAdding"
                                    >{{isAdding ? 'Updating..' : 'Add Post' }}</Button>
                    </div>
                </Modal>

	    <Modal
            v-model="editModal"
            title="Edit Post"
            :mask-closable="false"
            :closable="false"
            >
            <Input v-model="editData.title" placeholder="Edit title" />
            <div class="space">
            <Input v-model="editData.body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" ></Input>
            </div>

            <div slot="footer">
                <Button type="default" @click="editModal = false">Close</Button>
                <Button type="primary" @click="editPost" 
                            :disabled="isAdding" 
                            :loading="isAdding"
                            >{{isAdding ? 'Updating..' : 'Edit Post' }}</Button>
            </div>
        </Modal>

        <Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete post?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deletePost">Delete</Button>
					</div>
				</Modal>
        <router-view />
    </div>
</template>
<script>
import Paginator from '../../components/pagination/Paginator.vue';
import PaginatorDetails from '../../components/pagination/PaginatorDetails.vue';
export default {
     components:{
        Paginator,
        PaginatorDetails,
    },
     mounted(){
        this.getPosts();
    },
    data(){
            return{
                results: null,
                posts:{
                    title:'',
                    body:''
                },
                data:{
                     title:'',
                    body:''
                },
                addModal: false,
                editModal: false,
                isAdding: false,
                index: -1,
                showDeleteModal: false,
                isDeleting: false,
                deleteItem:{},
                deletingIndex: -1,
                 params:{
                    page:1
                  },
                  active:{
                dashboard:true,
                },
                editData: {
                    title: '',
                    body: ''
                },
                success_message: null,
                danger_message: null,
                keyword:''
            }
    },
     computed: {
            filterPost() {
            return this.posts.filter((post) => {
                return this.keyword.toLowerCase().split(' ').every(v => post.title.toLowerCase().includes(v));
            });
            }
        },
    methods:{
        getPosts: async function(){
            axios.get('app/get_post', {params: this.params}).then(response =>{
                            this.results = response.data.results
                            this.posts = response.data.results.data;
                           
                    })
        },
        getPage: function(event){
                this.params.page = event;
                window.scrollTo(0, 0);
                this.getPosts()
        },


        async addPost(){
			if(this.data.title.trim() == '')
			return this.error('Title is required');
            if(this.data.body.trim() == '')
			return this.error('Body is required');


			const res = await this.callApi('post', 'app/create_post',this.data);
			if(res.status == 201){
				 this.posts.unshift(res.data);
				 this.success('Post has been added successfully');
				 this.addModal = false;
				 this.data.title = '';
                 this.data.body = '';
			}else{
				if(res.status == 422){
					
              
                    if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
                    if(res.data.errors.body){
						this.error(res.data.errors.body[0])
					}
					
				}else{

                  
					this.swr();
				}
				 
			}
		},
        async editPost(){
			if(this.editData.title.trim() == '')
			return this.error('Title is required');

            
			const res = await this.callApi('post', 'app/edit_post',this.editData);
			if(res.status == 200){
				 this.posts[this.index].title = this.editData.title;
                this.posts[this.index].body = this.editData.body;
				 this.success('Post has been edited successfully');
				 this.editModal = false;
			}else{
				if(res.status == 422){
					if(res.data.errors.title){
						this.error(res.data.errors.title[0])
					}
                    if(res.data.errors.body){
						this.error(res.data.errors.body[0])
					}
					
				}else{
				this.flashDanger('Something went wrong');
				}
				 
			}

            
		},
        	async deletePost(){

			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_post',this.deleteItem);
			if(res.status === 200){
				this.posts.splice(this.deletingIndex,1);
				this.success('Post has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		},
    

         showEditModal(post, index){
				let obj = {
					id: post.id,
					title: post.title,
                    body:post.body
				};
				this.editData = obj;
				this.editModal = true;
				this.index = index;
		},
        showDeletingModal(post, i){
				
				this.deleteItem = post;
				this.deletingIndex  = i;
				this.showDeleteModal = true;
		},
        setActive: function(component){
                Object.keys(this.active).forEach(key => this.active[key] = false);
                this.active[component] = true;
        },
          flashSuccessAndReload: function(event){
                this.setActive('dashboard');
                this.flashSuccess(event); 
                this.getPosts();
        },
        flashSuccess: function(message){
            this.success_message = message;
            setTimeout(() => {
                this.success_message = null
            },5000);
        },
        flashDanger: function(message){
             this.danger_message = message;
            setTimeout(() => {
                this.danger_message = null
            },5000);
        }
    },

}
</script>
<style scoped>

.container-add
{
	width: auto;
	height:auto;
	margin-left: 250px;

}

table
{
	font-family:verdana;
	border-collapse: collapse;
	width: 100%;
}
td,th
{
	
	text-align: left;
	padding: 8px;
}



</style>