<?php include './head.php'?>
<style>
  /* HIDE RADIO */
  [type=radio] { 
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* IMAGE STYLES */
  [type=radio] + img {
    cursor: pointer;
  }

  /* CHECKED STYLES */
  [type=radio]:checked + img {
    outline: 4px solid #0275d8;
  }
</style>
<label>
  <input class="border border-5" type="radio" name="test" value="small" checked >
  <img src="./assets/img/avatars/icons8-anime-sama.svg" alt="Option 1">
</label>

<label>
  <input class="border border-primary" type="radio" name="test" value="big">
  <img src="./assets/img/avatars/icons8-futurama-bender.svg" alt="Option 2">
</label>
<label>
  <input class="border border-5" type="radio" name="test" value="small"  >
  <img src="./assets/img/avatars/icons8-anime-sama.svg" alt="Option 3">
</label>

<label>
  <input class="border border-primary" type="radio" name="test" value="big">
  <img src="./assets/img/avatars/icons8-futurama-bender.svg" alt="Option 4">
</label>
<label>
  <input class="border border-5" type="radio" name="test" value="small" >
  <img src="./assets/img/avatars/icons8-anime-sama.svg" alt="Option 1">
</label>

<label>
  <input class="border border-primary" type="radio" name="test" value="big">
  <img src="./assets/img/avatars/icons8-futurama-bender.svg" alt="Option 2">
</label>
<label>
  <input class="border border-5" type="radio" name="test" value="small"  >
  <img src="./assets/img/avatars/icons8-anime-sama.svg" alt="Option 1">
</label>

<label>
  <input class="border border-primary" type="radio" name="test" value="big">
  <img src="./assets/img/avatars/icons8-futurama-bender.svg" alt="Option 2">
</label>