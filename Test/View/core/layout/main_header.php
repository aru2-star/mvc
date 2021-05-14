
<nav class="navbar navbar-expand-sm bg-secondary sticky-top">
  <a class="navbar-brand pl-5 text-white" href="#">Quiz Application</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_question')?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Questions</a>
      </li>
     </ul>
  </div>
</nav>
