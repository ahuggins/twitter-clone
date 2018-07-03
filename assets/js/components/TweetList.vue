<template>
  <div class=" bg-white shadow">
    <div v-for="(tweet, index) in tweets" class="flex border-b border-solid border-grey-lighter px-5">
      <div class="w-full pt-3">
          <div class="flex justify-between mb-6">
            <div>
              <span class="font-bold">
                <a :href="'/user/' + tweet.user.username" class="text-blue no-underline">
                  {{ tweet.user.name }}
                </a>
              </span>
              <span class="text-grey-dark">
                @{{ tweet.user.username }}
              </span>
              <span class="text-grey-dark">·</span>
              <span class="text-grey-dark">
                {{ getHumanDate(tweet.createdAt.timestamp) }}
              </span>
            </div>
            <div v-show="tweet.user.username === username">
              <div class="block sm:inline-block cursor-pointer relative flex justify-between dropdown font-bold pl-8">
                <i class="fa fa-chevron-down fa-sm text-grey-dark"></i>
                <div class="hidden absolute w-full pin-l sm:pin-r z-30 border-t-2 bg-white border-blue-dark dropdown-content shadow">
                  <div class="border-b border-grey-light">
                    <a 
                      href="#"
                      class="text-sm block px-4 py-2 hover:bg-grey-lightest no-underline text-blue"
                      @click="deleteTweet(tweet, index)"
                    >
                      Delete Tweet
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-6">
            <p class="">
              {{ tweet.body }}
              </p>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import moment from 'moment'

export default {
  props: ['user', 'username'],
  data: function () {
    return {
      tweets: []
    }
  },
  methods: {
    getHumanDate: function (date) {
      return moment.unix(date).fromNow()
    },
    deleteTweet: function (tweet, index) {
      axios.delete('/tweet/' + tweet.id)
        .then((response) => {
          this.tweets.splice(index, 1)
        })
    }
  },
  mounted () {
    axios.get('/' + this.user.username + '/tweets')
      .then(response => {
        this.tweets = response.data
      })
  },
  created () {
    this.$eventBus.$on('add-tweet', (data) => {
      this.tweets.unshift(data)
    })
  }
}
</script>
