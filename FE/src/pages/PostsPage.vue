<template>
  <q-page padding>
    <!-- content -->
    <div v-if="posts.length > 0"></div>
    <div v-else>
      <q-btn
        icon="add"
        class="full-width"
        color="primary"
        label="Start Posting"
        @click="$router.push('/addpost')"
        rounded
      />
    </div>
  </q-page>
</template>

<script>
import { reactive, toRefs } from "vue";
export default {
  // name: 'PageName',
  setup() {
    const props = reactive({
      posts: [],
    });
    function fethMyPosts() {
      api.get("api/myposts").then((r) => {
        props.posts = r.data.myPosts;
      });
    }
    return {
      ...toRefs(props),
    };
  },
};
</script>
