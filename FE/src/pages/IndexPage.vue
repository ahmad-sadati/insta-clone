<template>
  <q-page class="flex flex-center">
    <q-btn
      class="full-width"
      color="blue"
      rounded
      label="Register"
      @click="$router.push('/register')"
    ></q-btn>
  </q-page>
</template>

<script>
import { api } from "src/boot/axios";
import { defineComponent, toRefs } from "vue";

export default defineComponent({
  name: "IndexPage",
  setup() {
    const props = reactive({
      userData: null,
    });
    function fetchMe() {
      api.get(api.user).then((r) => {});
    }
    fetchMe();
    return {
      ...toRefs(),
    };
  },
});
</script>
