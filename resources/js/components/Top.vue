<template>
    <div class="top row" id="top">
        <div class="col-7 col-lg-7 pl-0">
            <form class="search" @submit.prevent="loadInfo">
                <div class="input-group">
                    <input type="text" v-model="url" :disabled="loading" class="form-control my-0 py-1 mb-2 ml-0 mr-3" id="url" placeholder="https://twitter.com/yourusername or https://www.instagram.com/yourusername ">
                    <button type="submit" :disabled="!url || loading" class="btn btn-warning mb-2">Load</button>
                </div>
            </form>
        </div>
        <div class="col-3 col-lg-3">
            <div class="content-account">
                <div class="avata-area">
                    <div class="image-container">
                      <div class="spinner-border" role="status">
                          <span class="sr-only">Loading...</span>
                      </div>
                        <img :src="user.profile_pic ? user.profile_pic : 'img/default.jpeg' " alt="Image">
                    </div>
                </div>
                <div class="text-area">
                    <div class="account-name">
                          <div id='containerLoad' :class="{active : loadingLogin}">
                              <div class='loader'>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                                <div class='loader--dot'></div>
                              </div>
                          </div>
                          <div class="text-name-id" :class="{active : loadingLogin}">
                              <div class="text-left text-name">{{ user.name }}</div>
                              <div class="text-left text-id">{{ user.username }}</div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 col-lg-2 pr-0">
            <form @submit.prevent="action" class="search-date">
                <div class="input-group">
                    <select v-model="form.date" class="form-control my-0 py-1 mx-sm-3 mb-2">
                        <option disabled value="">Select Time</option>
                        <option v-for="month in dateRange" :value="month">{{ month }}</option>
                    </select>
                    <button type="submit" :disabled="!form.date || !user || loading" class="btn btn-warning mb-2 apply">Apply</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                url: "",
                instagram: false,
                loading: false,
                loadingLogin: false,
                form: {
                    username: '',
                    date:''
                },
                user: {
                    username: '',
                    name: '',
                    profile_pic: ''
                },
                dateRange: []
            }
        },
        created(){
            this.selectboxMonth();
            this.$eventBus.$on('insChecked', (instagram) => {
                this.form.username = instagram[0].id;
                this.user.profile_pic = instagram[0].profile_picture_url;
                this.user.name = instagram[0].name;
                this.user.username = instagram[0].username;
                this.url = 'https://www.instagram.com/' + instagram[0].username
            });
        },
        methods: {
            fetchTweet(query){
                axios.get('/api/tweets?' + query)
                    .then(res => {
                        this.instagram = false;
                        this.$eventBus.$emit('dataEvent', res.data.data, this.form, this.user, this.instagram );
                        this.loading = false;
                    })
                    .catch(err => {
                        this.loading = false;
                        this.$eventBus.$emit('ERR');
                        
                        console.log(err);
                    });
            },
            fetchIns(query){
                axios.get('/medias?' + query)
                    .then(res => {
                        this.instagram = true;
                        this.$eventBus.$emit('dataEvent', res.data, this.form, this.user, this.instagram);
                        this.loading = false;
                    })
                    .catch(err => {
                        this.loading = false;
                        this.$eventBus.$emit('ERR');

                        console.log(err);
                    });
            },
            loadInfo(){
                if(!this.checkUrl(this.url)) return false;
                this.loading = true;
                this.loadingLogin = true;
                this.$eventBus.$emit('newAccount', this.loadingLogin);
                if(this.isTwitter(this.url)){
                    this.getUserNameFromURL(this.url);
                    axios.get('/api/twprofile?username=' + this.form.username)
                        .then(res => {
                            this.loadingLogin = false;
                            this.loading = false;
                            this.user = {
                                profile_pic: res.data.profile_image_url_https,
                                name: res.data.name,
                                username: res.data.screen_name
                            };
                        })
                        .catch(err => {
                            this.$eventBus.$emit('ERR');
                            this.loading = false;

                            console.log(err)
                        });
                }else{
                    window.location.href = '/login/facebook';
                }
            },
            selectboxMonth() {
                let date1 = new Date();
                let month = ("0" + (date1.getMonth() + 1)).slice(-2);
                this.dateRange.push(date1.getFullYear() + '/' + month );
                date1.setMonth(date1.getMonth() - 1);
                month = ("0" + (date1.getMonth() + 1)).slice(-2);
                this.dateRange.push(date1.getFullYear() + '/' + month );
                date1.setMonth(date1.getMonth() - 1);
                month = ("0" + (date1.getMonth() + 1)).slice(-2);
                this.dateRange.push(date1.getFullYear() + '/' + month );
            },
            action(){
                if(!this.checkUrl(this.url)) return false;
                this.loading = true;
                this.$eventBus.$emit('applyClick', this.loading);
                this.getUserNameFromURL(this.url);
                if(this.isTwitter(this.url)){
                    let query = "username="+ this.form.username + '&date_req=' + this.form.date.replace('/', '-');
                    this.fetchTweet(query);
                }else{
                    let query = "ig_user_id="+ this.form.username + '&date_req=' + this.form.date.replace('/', '-');
                    this.fetchIns(query);
                }
            },
            isTwitter: (url) => {
                const TWHOST = 'https://twitter.com/';
                return (url.includes(TWHOST) > 0) ? true : false;
            },
            getUserNameFromURL(url){
                if(!this.isTwitter(this.url)) return false;
                this.form.username = url.split('/')[3];
            },
            checkUrl: (url) => {
                const TWHOST = 'https://twitter.com/';
                const INSHOST = 'https://www.instagram.com';
                
                if( url.includes(TWHOST) > 0 || url.includes(INSHOST) > 0) return true;
                
                alert('URL Wrong! \n You need a link: \n https://twitter.com/alex or https://www.instagram.com/alex');
                return false;
            }
        }
    }
</script>