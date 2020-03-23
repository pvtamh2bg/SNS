<template>
    <div class="pdm-list-ins">
        <div class="wrapper" style="padding: 30px 50px 50px 50px; justify-content: center;">
            <div class="box" v-for="instagram in data" :key="instagram.id" :class="{'no-download': instagram.media_type === 'VIDEO' || instagram.media_type === 'CAROUSEL_ALBUM'}">
                <div class="content-container">
                    <div class="top-content">
                        <div class="icon-container">
                    <span class="sns-icon">
                        <img src='img/instagram.png' alt="Image">
                    </span>
                        </div>
                        <div class="text-top-content">
                            <div class="sns-name">
                                <p><b>Instagram</b></p>
                            </div>
                            <div class="sns-account">
                                <p>{{ instagram.username }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="image-content">
                        <div class="date-area" style="display: none;">
                            <div class="text-date-area">
                                {{ dateFormat(instagram.timestamp) }}
                            </div>
                        </div>
                        <a :href="instagram.media_url" target="_blank">
                            <video v-if="instagram.media_type === 'VIDEO'" width="100%" height="100%" controls>
                                <source :src="instagram.media_url" type="video/mp4">
                            </video>
                            <img v-else v-bind:src="instagram.media_url" alt="Image">
                        </a>
                    </div>
                    <div class="icon-function-area">
                        <div class="row" style="margin: 0 auto;">
                            <div class="col-4 col-md-3 reaction">
                                <i class="fa fa-heart-o" aria-hidden="true"
                                   style="margin-top: 3px; margin-right: 3px;"></i>
                                <div class="number-like">{{ instagram.like_count }}</div>
                            </div>
                            <div class="col-4 col-md-3 reaction">
                                <i class="fa fa-comment-o" aria-hidden="true"
                                   style="margin-top: 3px; margin-right: 3px;"></i>
                                <div class="number-like">{{ instagram.comments_count }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="description-content">
                        <p>{{ instagram.caption}}</p>
                    </div>
                    <div class="date-time-area">
                        {{ instagram.timestamp }}
                    </div>
                </div>
            </div>
            <h2 v-if="messages" class="alert alert-info text-center" style="font-size: 18px">{{ messages }}</h2>
        </div>
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
