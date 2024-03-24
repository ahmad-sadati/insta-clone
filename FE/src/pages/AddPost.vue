<template>
  <q-page padding>
    <!-- content -->
    <div class="row q-col-gutter-md">
      <div class="col-12">
        <q-input v-model="text" type="text" label="Post Title" />
      </div>
      <div class="col-12">
        <q-input
          autogrow
          v-model="text"
          type="textarea"
          label="Post Description"
        />
      </div>
      <div class="col-12">
        <q-btn
          class="full-width"
          label="Save"
          color="light-green"
          rounded
          icon="send"
        />
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  // name: 'PageName',
};
</script>
