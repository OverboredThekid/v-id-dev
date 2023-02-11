<div>
<div class="center-container">
  <div class="button-container">
    <button class="red-button" wire:click='$emit("openModal", "show-i-ds", {{ json_encode(["whichSide" => "1" ]) }})'>
      <span class="text">Edit Front Card ID's</span>
      <span class="icon">📝</span>
    </button>
    <button class="blue-button" wire:click='$emit("openModal", "show-i-ds", {{ json_encode(["whichSide" => "2" ]) }})'>
      <span class="text">Edit Back Card ID's</span>
      <span class="icon">📝</span>
    </button>
  </div>
</div>

<style>
  .center-container {
    text-align: center;
  }

  .button-container {
    display: flex;
    justify-content: center;
    margin: 12px;
  }

  .red-button {
    background-color: #FF0000;
    color: #FFFFFF;
    padding-left: 6px;
    border-radius: 50px;
    display: flex;
    align-items: center;
  }

  .blue-button {
    background-color: #0000FF;
    color: #FFFFFF;
    padding-left: 6px;
    border-radius: 50px;
    display: flex;
    align-items: center;
  }

  .text {
    margin-right: 6px;
  }

  .icon {
    background-color: #4B0082;
    width: 16px;
    height: 16px;
    display: inline-block;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .icon:hover {
    background-color: #483D8B;
  }
</style>

</div>
