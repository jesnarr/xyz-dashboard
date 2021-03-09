<template>
<div>
<div class="content">
	<div class="container-fluid">

	<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
	<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
		<p class="_title0">Category  <Button @click="addModal = true"><Icon type="md-add" /> Add Category</Button> </p>
		

		<div class="_overflow _table_div">
			<table class="_table">
					<!-- TABLE TITLE -->
				<tr>
					<th>ID</th>
					<th>Category Name</th>
					<th>Icon Image</th>
					<th>Created at</th>
					<th>Action</th>
				</tr>
					<!-- TABLE TITLE -->

  				<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
					<!-- ITEMS -->
				<tr v-for="(category, i) in categories" :key="i" v-if="categories.length">
					<td>{{category.id}}</td>
					<td class="_table_name">{{category.categoryName}}</td>
					<td><img :src="`${category.iconImage}`" style="width:50px;"/></td>
					<td>{{ category.created_at }}</td>
					<td>
						<Button type="info" size="small" @click="showEditModal(category, i)">Edit</Button>
						<Button type="error" size="small" @click="showDeletingModal(category, i)"
							:loading="category.isDeleting"
						>Delete</Button>
						
					</td>
				</tr>
				


			</table>



		</div>
		</div>
				<!-- adding of new tag -->
				<Modal
					v-model="addModal"
					title="Add category"
					:mask-closable="false"
					:closable="false"
					>
					<Input v-model="data.categoryName" placeholder="Add category name" />
                    <!-- uploading of images -->
					<!-- <div class="demo-upload-list" v-for="item in uploadList">
					<template v-if="item.status === 'finished'">
						<img :src="item.url">
						<div class="demo-upload-list-cover">
							<Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
							<Icon type="ios-trash-outline" @click.native="handleRemove(item)"></Icon>
						</div>
					</template>
					<template v-else>
						<Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
					</template>
				</div> -->
                    <div class="space">
                       <Upload
					   		ref="uploads"
                            type="drag"
                            :headers="{'x-csrf-token' : token, 'X-Requested-With' :'XMLHttpRequest'}"
                            :on-success="handleSuccess"
                            :on-error="handleError"
                            :max-size="2048"
                            :format="['jpg','jpeg','png']"
                            :on-format-error="handleFormatError"
                            :on-exceeded-size="handleMaxSize"
                            action="/app/upload"
                            
                            >
                            <div style="padding: 20px 0">
                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                <p>Click or drag files here to upload</p>
                            </div>
                        </Upload>
						
						<div class="demo-upload-list" v-if="data.iconImage">
								 <img :src="`/upload/${data.iconImage}`"/>
								 <div class="demo-upload-list-cover">
									 <Icon type="ios-trash-outline" @click="deleteImage" ></Icon>
								 </div>
						</div>
                        <!-- <div class="image_thumb" v-if="data.iconImage">
                                <img :src="`/upload/${data.iconImage}`"/>
                        </div> -->

                    </div>
					<div slot="footer">
						<Button type="default" @click="addModal = false">Close</Button>
						<Button type="primary" @click="addCategory" 
									:disabled="isAdding" 
									:loading="isAdding"
									>{{isAdding ? 'Adding..' : 'Add Category' }}</Button>
					</div>
				</Modal>

				<!-- editing -->
				<Modal
					v-model="editModal"
					title="Add category"
					:mask-closable="false"
					:closable="false"
					>
					<Input v-model="editData.categoryName" placeholder="Edit category name" />

					 <div class="space">
                       <Upload
					   		v-show="isIconImageNew"
					   		ref="editDataUplods"
                            type="drag"
                            :headers="{'x-csrf-token' : token, 'X-Requested-With' :'XMLHttpRequest'}"
                            :on-success="handleSuccess"
                            :on-error="handleError"
                            :max-size="2048"
                            :format="['jpg','jpeg','png']"
                            :on-format-error="handleFormatError"
                            :on-exceeded-size="handleMaxSize"
                            action="/app/upload"
                            >
                            <div style="padding: 20px 0">
                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                <p>Click or drag files here to upload</p>
                            </div>
                        </Upload>
						
						<div class="demo-upload-list" v-if="editData.iconImage">
								 <img :src="`${editData.iconImage}`"/>
								 <div class="demo-upload-list-cover">
									 <Icon type="ios-trash-outline" @click="deleteImage(false)" ></Icon>
								 </div>
						</div>
                        <!-- <div class="image_thumb" v-if="data.iconImage">
                                <img :src="`/upload/${data.iconImage}`"/>
                        </div> -->

                    </div>

					<div slot="footer">
						<Button type="default" @click="closeEditModal">Close</Button>
						<Button type="primary" @click="editCategory" 
									:disabled="isAdding" 
									:loading="isAdding"
									>{{isAdding ? 'Updating..' : 'Edit category' }}</Button>
					</div>
				</Modal>
					<!-- delete alert modal -->
				<Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete category?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deleteCategory">Delete</Button>
					</div>
				</Modal>
				<!-- <deleteModal></deleteModal> -->
	</div>
</div>
</div>
</template>

<script>
import deleteModal from '../components/deleteModal';

export default {
	data(){
		return{
			data: {
				iconImage: '',
                categoryName: ''
				
			},
			addModal: false,
			editModal: false,
			isAdding: false,
			categories: [],
			editData: {
				iconImage: '',
				categoryName: ''
			},
			index: -1,
			showDeleteModal: false,
			isDeleting: false,
			deleteItem:{},
			deletingIndex: -1,
            token: '',
			isIconImageNew: false,
			isEditingItem: false,
		}
	},
	methods:{
		async addCategory(){
			if(this.data.categoryName.trim() == '')
			return this.error('Category name is required');
			if(this.data.iconImage.trim() == '')
			return this.error('Image is required');
			
			this.data.iconImage = `/upload/${this.data.iconImage}`;
			const res = await this.callApi('post', 'app/create_category',this.data);
			if(res.status == 201){
				 this.categories.unshift(res.data);
				 this.success('Category has been added successfully');
				 this.addModal = false;
				 this.data.categoryName = '';
				 this.data.iconImage = '';
			}else{
				if(res.status == 422){
					if(res.data.errors.categoryName){
						this.error(res.data.errors.categoryName[0])
					}
					
					if(res.data.errors.iconImage){
						this.error(res.data.errors.iconImage[0])
					}
					
					
				}else{
					this.swr();
				}
				 
			}
		},
		// edit category
		async editCategory(){
			if(this.editData.categoryName.trim() == '')
			return this.error('Category name is required');
			if(this.editData.iconImage.trim() == '')
			return this.error('Image is required');

			// this.editData.iconImage = `/upload/${this.editData.iconImage}`;
			const res = await this.callApi('post', 'app/edit_category',this.editData);
			if(res.status == 200){
				 this.categories[this.index].categoryName = this.editData.categoryName;
				this.categories[this.index].iconImage = this.editData.iconImage;
				 this.success('Category has been edited successfully');
				 this.editModal = false;
			}else{
				if(res.status == 422){
					if(res.data.errors.categoryName){
						this.error(res.data.errors.categoryName[0])
					}
					if(res.data.errors.iconImage){
						this.error(res.data.errors.iconImage[0])
					}
					
				}else{
					this.swr();
				}
				 
			}
		},
		// show modal of edit
		showEditModal(category, index){
				let obj = {
					id: category.id,
					categoryName: category.categoryName,
					iconImage: category.iconImage
				};
				this.editData = obj;
				this.editModal = true;
				this.index = index;
				this.isEditingItem = true;
		},
		// show modal of delete
		showDeletingModal(category, i){
				
				this.deleteItem = category;
				this.deletingIndex  = i;
				this.showDeleteModal = true;
		},
		// delete category
		async deleteCategory(){
			// add loading
			// this.$set(tag, 'isDeleting', true);
			this.isDeleting = true;
			const res = await this.callApi('post', 'app/delete_category',this.deleteItem);
			if(res.status === 200){
				this.categories.splice(this.deletingIndex,1);
				this.success('Category has been deleted successfully');
			}else{
				this.swr();
			}
			this.isDeleting = false;
			this.showDeleteModal = false;
		},
        // files
            handleSuccess (res, file) {
				
				if(this.isEditingItem){
					res = `/upload/${res}`;
					return this.editData.iconImage = res;
				}

                this.data.iconImage = res;
				
            },
             handleError (res, file) {
              this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: `${file.errors.file.length ? file.errors.file[0] : 'Something went wrong'}`
                });
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },
        // end of files
		// deleting of image
		async deleteImage(isAdd = true){
			let image;
			if(!isAdd){
				this.isIconImageNew = true;
			 	 image = this.editData.iconImage.replace('/upload/','');
				console.log(image);
			 	this.editData.iconImage = '';
			 	this.$refs.editDataUplods.clearFiles();
				
			}else{
				 image = this.data.iconImage;
				this.data.iconImage = '';
				this.$refs.uploads.clearFiles();
			}

			const res = await this.callApi('post', 'app/delete_image', {imageName: image});
				if(res.status != 200){
					this.editData.iconImage = image;
					this.swr();
				}
			
			
			
		},
		closeEditModal(){
			this.editModal = false;
			this.isEditingItem = false;
			
		}
		// 	async deleteEditImage(){
		
		// 	const res = await this.callApi('post', 'app/delete_image', {imageName: image});
		// 	if(res.status != 200){
		// 		this.editData.iconImage = image;
		// 		this.swr();
		// 	}else{

		// 	}
		// }
	},

	async created(){
            this.token = window.Laravel.csrfToken;
			const res = await this.callApi('get', '/app/get_category');
			if(res.status == 200){
				this.categories = res.data
			}else{
				this.swr();
			}
	},
	components: {
		deleteModal
	}
}
</script>

<style scoped>
	 .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
	 .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
</style>