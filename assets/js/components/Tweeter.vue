<template>
  <div class="flex-none bg-white shadow p-4">  
    <label class="font-bold text-sm">
      Tweet to your followers!
    </label>
    <div class="my-4">
      <textarea
        class="w-full border border-grey-light rounded p-2 text-sm"
        placeholder="Make It Count!"
        v-model="body"
        rows=7
      ></textarea>
      <span class="float-right text-grey text-sm">
        <span
          v-bind:class="charactersRemaining < 20 ? 'text-red font-bold' : charactersRemaining < 40 ? 'text-orange-light font-bold' : ''"
        >
          {{ charactersRemaining }}
        </span> 
        <span 
          v-bind:class="charactersRemaining < 0 ? 'text-red font-bold' : ''"
        >
          Characters
        </span>
      </span>
    </div>
    <button
      type="submit"
      class="rounded px-6 py-2 text-white"
      v-bind:disabled="! isTweetable"
      v-bind:class="isTweetable ? 'bg-blue' : 'bg-grey cursor-not-allowed'"
      @click="postTweet"
    >
      Tweet
    </button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  props: ['username'],
  data: function () {
    return {
      body: null,
      characterLimit: 250
    }
  },
  computed: {
    isTweetable: function () {
      return ! (this.charactersRemaining < 0 || this.charactersRemaining === this.characterLimit)
    },
    charactersRemaining: function () {
      return this.body ? this.characterLimit - this.body.split('').length : this.characterLimit
    }
  },
  methods: {
    postTweet() {
      axios.post("/tweet", {"body": this.body}, { headers: {'Content-Type': 'multipart/x-www-form-urlencoded'}})
        .then(
          (response) => {
            this.addTweet(response.data)
            this.body = ''
          }
        )
    },
    addTweet(data) {
      if (data.user.username === this.username) {
        this.$eventBus.$emit('add-tweet', data)
      }
    }
  }
}
</script>
