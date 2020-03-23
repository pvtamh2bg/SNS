<template>
    <div class="pdm-list-tweets">
        <div class="modal fade" id="Pages" tabindex="-1" role="dialog" aria-labelledby="PagesModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 280px;">
                    <div class="modal-header">
                        <p class="modal-title" id="exampleModalLabel" style="font-weight: 600;">Choose Instagram Account</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label v-for="page in pages" class="dropdown-item select-menu-item assignment-name chooseName checkbox-item" role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="chk1-label" style=" ">
                            <svg class="octicon octicon-check select-menu-item-icon" width="12" height="16" viewBox="0 0 12 16" aria-hidden="true" style="visibility: hidden; margin-right: 7px; margin-top: 2px;">
                                <path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z" />
                            </svg>
                            <input v-model="instagram" type="checkbox" style="display: none;" id="select-app" name="page" :value="page.instagram_business_account" data-id="222222" class="edit-check-assignee" data-name="" data-avatar="">
                            <div class="page-image-container">
                                <img :src='page.instagram_business_account.profile_picture_url' alt="Image">
                            </div>
                            <div class="page-text" style="margin-top: 4px;">
                                <span class="page-name" style="font-size: 14px;">{{ page.instagram_business_account.name }}</span>
                            </div>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" :disabled="instagram.length == 0" data-dismiss="modal" @click="add" class="btn btn-primary btn-sm">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
               pages: [],
               instagram: []
            }
        },
        created(){
            axios.get('/pages')
                .then(res => {
                   this.pages = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        methods: {
            add(){
                this.$eventBus.$emit('insChecked', this.instagram);
            }
        }

    }
</script>
