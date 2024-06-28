<?php
// function to get the current page name
function PageName()
{
  return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$current_page = PageName();
?>
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item ">
      <a class="nav-link <?php echo $current_page == 'mainpage.php' ? NULL : 'collapsed' ?>" href="mainpage.php">
        <i class="bi bi-grid"></i>
        <span>Main</span>
      </a>
    </li><!-- End Dashboard Nav -->
    <li class="nav-item">
      <a class="nav-link <?php echo $current_page == 'lessonPage.php' ? NULL : 'collapsed' ?>" href="lessonPage.php">
        <i class="bi bi-menu-button-wide"></i><span>Study Material</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link  <?php echo $current_page == 'listExercisePage.php' ? NULL : 'collapsed' ?>" href="listExercisePage.php">
        <i class="bi bi-file-earmark-post"></i><span>Exercise</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link  <?php echo $current_page == 'listTestPage.php' ? NULL : 'collapsed' ?>" href="listTestPage.php">
        <i class="bi bi-journal-text"></i><span>Test</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo $current_page == 'listFeedbackPage.php' ? NULL : 'collapsed' ?>" href="listFeedbackPage.php">
        <i class="bi bi-layout-text-window-reverse"></i><span>Feedback</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo $current_page == 'myProfilePage.php' ? NULL : 'collapsed' ?>" href="myProfilePage.php">
        <i class="bi bi-person"></i><span>My Profile</span>
      </a>
    </li>


  </ul>

</aside><!-- End Sidebar-->