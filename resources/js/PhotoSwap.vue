<template>
    <div class="photo-container">
      <img
        :src="firstPhotoSrc"
        :alt="firstPhotoAlt"
        :class="{ hidden: showSecondPhoto, fade: !showSecondPhoto }"
        @mouseover="showSecondPhoto = true"
        @mouseout="showSecondPhoto = false"
      >
      <img
        :src="secondPhotoSrc"
        :alt="secondPhotoAlt"
        :class="{ hidden: !showSecondPhoto, fade: !showSecondPhoto }"
      >
    </div>
  </template>

  <script>
  export default {
    props: {
      firstPhotoSrc: String,
      firstPhotoAlt: String,
      secondPhotoSrc: String,
      secondPhotoAlt: String,
    },
    data() {
      return {
        showSecondPhoto: false,
      };
    },
  };







  </script>
