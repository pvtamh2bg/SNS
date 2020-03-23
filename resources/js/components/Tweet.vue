<template>
    <div class="pdm-list-tweets">
        <div class="wrapper" style="padding: 30px 50px 50px 50px; justify-content: center;">
            <div class="box" v-for="tweet in data" :key="tweet.id" :class="{'no-download': tweet.entities === '' || tweet.entities[0].type !== 'photo'}">
                <div class="content-container">
                    <div class="top-content">
                        <div class="icon-container">
						<span class="sns-icon">
							<img src='img/twitter_icon.png' alt="Image">
						</span>
                        </div>
                        <div class="text-top-content">
                            <div class="sns-name">
                                <p><b>Twitter</b></p>
                            </div>
                            <div class="sns-account">
                                <p>{{ tweet.screen_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="image-content">
                        <div class="date-area" style="display: none;">
                            <div class="text-date-area">
                                {{ dateFormat(tweet.created_at) }}
                            </div>
                        </div>
                        <a v-if="tweet.entities" :href="(tweet.entities === '') ? '#' : tweet.entities[0].media_url_https" target="_blank">
                            <video v-if="tweet.entities[0].type === 'video' || tweet.entities[0].type === 'animated_gif'" width="100%" height="100%" controls>
                                <source :src="tweet.entities[0].video_info.variants[0].url" type="video/mp4">
                            </video>
                            <img v-else v-bind:src="tweet.entities[0].media_url_https" alt="Image">
                        </a>
                    </div>
                
                    <div class="icon-function-area">
                        <div class="row" style="margin: 0 auto;">
                            <div class="col-4 col-md-3 reaction">
                                <i class="fa fa-heart-o" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
                                <div class="number-like">{{ tweet.favorite_count }}</div>
                            </div>
                            <div class="col-4 col-md-3 reaction">
                                <i class="fa fa-retweet" aria-hidden="true" style="margin-top: 3px; margin-right: 3px;"></i>
                                <div class="number-like">{{ tweet.retweet_count }}</div>
                            </div>
                        </div>
                    </div>
                
                    <div class="description-content">
                        <p>{{ tweet.text }}</p>
                    </div>
                
                    <div class="date-time-area">
                        {{ tweet.created_at }}
                    </div>
                </div>
            </div>
        </div>
        <h2 v-if="messages" class="alert alert-info text-center" style="font-size: 18px">{{ messages }}</h2>
    </div>
</template>

<script>
    export default {
        props: {
            data: [Array, Object],
            messages: ''
        },
        methods: {
            dateFormat: function(strdate){
                strdate = strdate.split('.')[1];
                return strdate.replace(/\//g, '-');
            }
        }
    }
</script>
