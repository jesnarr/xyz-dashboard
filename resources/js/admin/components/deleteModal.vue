<template>
    <div>
                <!-- delete alert modal -->
				<Modal :value="getDeleteModalObj.showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete tag?</p>
						
					</div>
					<div slot="footer">
						<Button type="error" size="large" long 
						:loading="isDeleting"  
						:disabled="isDeleting"
						@click="deleteTag">Delete</Button>
					</div>
				</Modal>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
    data(){
        return {
            isDeleting: false,
		
        }
    },
    computed: {
        ...mapGetters(['getDeleteModalObj'])
    },
    methods: {
            async deleteTag(){
			// add loading
			// this.$set(tag, 'isDeleting', true); 'app/delete_tag
			// this.isDeleting = true;
			// const res = await this.callApi('post', getDeleteModalObj.deleteUrl,getDeleteModalObj.data);
			// if(res.status === 200){
			// 	// this.tags.splice(this.deletingIndex,1);
			// 	this.success('Tag has been deleted successfully');
			// }else{
			// 	this.swr();
			// }
			// this.isDeleting = false;
			// this.showDeleteModal = false;

            this.$store.commit('setDeleteModal');
		}
    }
}
</script>