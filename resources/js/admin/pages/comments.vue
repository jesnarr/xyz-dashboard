<template>
   
        <div>
           <div class="container-add" id ="containerId" >
             
             
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
                            <p class="_title0">COMMENTS  <Button @click="addModal = true"><Icon type="md-add" /> Add comment</Button> </p>
                           <div class="space">
                           <Input v-model="keyword" placeholder="Search comments" />
                           </div>
                        <table id="datatable" class="table table-striped table-bordered lms-font-color-brown lms-font-family-roboto-slab" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>POST ID</th> 
                                    <th>NAME</th>  
                                    <th>EMAIL</th>
                                    <th>BODY</th>
                                    <th>ACTION</th>              

                                </tr>
                            </thead>

                    
                         <tbody v-if="results !==null">
                             
                    	<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
                            <tr v-for="(comment, i) in filterComments" :key="i" v-if="comments.length">
                                <td>{{comment.id}}</td>
                                <td class="_table_name">{{comment.postId}}</td>
                                 <td>{{ comment.name }}</td>
                                <td>{{ comment.email }}</td>
                                <td> {{ comment.body }}</td>
                              
                                <td>
                                <div class="btn-group">
                                    <!-- <button class="btn btn-secondary btn-sm" title="View User Logs" @click="viewUserLogs(user)"><i class="fas fa-list-alt"></i></button> -->
                                    <button class="btn btn-sm btn-warning" @click="showEditModal(comment, i)"><i class="fa fa-edit"></i></button>
                                     <button class="btn btn-sm btn-danger" @click="showDeletingModal(comment, i)"><i class="fa fa-trash"></i></button>
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
            <Modal
                    v-model="addModal"
                    title="Add comment"
                    :mask-closable="false"
                    :closable="false"
                    >
                    <Input v-model="data.name" placeholder="Name" />
                     <div class="space">
                    <Input v-model="data.email" placeholder="Email" />
                    </div>
                    <div class="space">
                    <Input v-model="data.body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" ></Input>
                    </div>

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" @click="addComment" 
                                    :disabled="isAdding" 
                                    :loading="isAdding"
                                    >{{isAdding ? 'Updating..' : 'Add Comment' }}</Button>
                    </div>
                </Modal>

	    <Modal
            v-model="editModal"
            title="Edit comment"
            :mask-closable="false"
            :closable="false"
            >
            <Input v-model="editData.name" placeholder="Edit name" />
            <div class="space">
            <Input v-model="editData.email" placeholder="Edit email" />
            </div>
            <div class="space">
            <Input v-model="editData.body" type="textarea" :autosize="{minRows: 2,maxRows: 5}" ></Input>
            </div>

            <div slot="footer">
                <Button type="default" @click="editModal = false">Close</Button>
                <Button type="primary" @click="editComment" 
                            :disabled="isAdding" 
                            :loading="isAdding"
                            >{{isAdding ? 'Updating..' : 'Edit Comment' }}</Button>
            </div>
        </Modal>

        <Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete comment?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deleteComment">Delete</Button>
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
        this.getComments();
    },
    data(){
            return{
                results: null,
                comments:{
                    name:'',
                    body:''
                },
                data:{
                     name:'',
                     email:'',
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
                    name: '',
                    body: '',
                    email:''
                },
                keyword:'',
                success_message: null,
                danger_message: null
            }
    },
     computed: {
            filterComments() {
            return this.comments.filter((comment) => {
                return this.keyword.toLowerCase().split(' ').every(v => comment.name.toLowerCase().includes(v));
            });
            }
        },
    methods:{
        getComments: async function(){
            axios.get('app/get_comments', {params: this.params}).then(response =>{
                            this.results = response.data.results
                            this.comments = response.data.results.data;
                           
                    })
        },
        getPage: function(event){
                this.params.page = event;
                window.scrollTo(0, 0);
                this.getComments()
        },


        async addComment(){
			if(this.data.name.trim() == '')
			return this.error('Title is required');
            if(this.data.body.trim() == '')
			return this.error('Body is required');
            if(this.data.email.trim() == '')
			return this.error('Email is required');
    



			const res = await this.callApi('post', 'app/create_comment',this.data);
			if(res.status == 201){
				 this.comments.unshift(res.data);
				 this.success('Comment has been added successfully');
				 this.addModal = false;
				 this.data.name = '';
                 this.data.body = '';
                 this.data.email ='';
			}else{
				if(res.status == 422){
					
              
                    if(res.data.errors.name){
						this.error(res.data.errors.name[0])
					}
                    if(res.data.errors.body){
						this.error(res.data.errors.body[0])
					}
                     if(res.data.errors.email){
						this.error(res.data.errors.email[0])
					}
					
				}else{

                  
					this.swr();
				}
				 
			}
		},
        async editComment(){
			if(this.editData.name.trim() == '')
			return this.error('Title is required');
            if(this.editData.body.trim() == '')
			return this.error('Body is required');
             if(this.editData.email.trim() == '')
			return this.error('Email is required');
            
			const res = await this.callApi('post', 'app/edit_comment',this.editData);
			if(res.status == 200){
				 this.comments[this.index].name = this.editData.name;
                 this.comments[this.index].body = this.editData.body;
                 this.comments[this.index].email = this.editData.email;

				 this.success('Edit has been edited successfully');
				 this.editModal = false;
			}else{
				if(res.status == 422){
					if(res.data.errors.name){
						this.error(res.data.errors.name[0])
					}
                    if(res.data.errors.body){
						this.error(res.data.errors.body[0])
					}
                    if(res.data.errors.email){
						this.error(res.data.errors.email[0])
					}
					
				}else{
				this.flashDanger('Something went wrong');
				}
				 
			}

            
		},
        	async deleteComment(){

			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_comment',this.deleteItem);
			if(res.status === 200){
				this.comments.splice(this.deletingIndex,1);
				this.success('Comment has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		},
         showEditModal(comment, index){
				let obj = {
					id: comment.id,
					name: comment.name,
                    email: comment.email,
                    body:comment.body
				};
				this.editData = obj;
				this.editModal = true;
				this.index = index;
		},
        showDeletingModal(comment, i){
				
				this.deleteItem = comment;
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
                this.getComments();
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