<?php 
declare(strict_types=1);
if (isset($_GET['title']) && $_GET['title'] !== '') {
    if (isset($_GET['event_types']) && $_GET['event_types'] !== '') {
        $events = searchEventByTitleAndType($_GET['title'], $_GET['event_types']);
        renderView('search_result_get', array('events' => $events));
        exit();
    } else {
        $events = searchEventByTitle($_GET['title']);
        renderView('search_result_get', array('events' => $events));
        exit();
    }
} 
elseif (isset($_GET['event_types']) && $_GET['event_types'] !== '' && ($_GET['start_date'] === '' && $_GET['end_date'] === '') && $_GET['title'] === '') {
    $events = searchEventByTypes($_GET['event_types']);
    renderView('search_result_get', array('events' => $events));
    exit();
} 

elseif (isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['title'] === '' && $_GET['event_types'] === '') {
    $events = searchByTime($_GET['start_date'], $_GET['end_date']);
    renderView('search_result_get', array('events' => $events));
    exit();
} 
elseif (isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['event_types'] !== '' && $_GET['title'] !== '') {
    $events = searchByTime($_GET['start_date'], $_GET['end_date']);
    renderView('search_result_get', array('events' => $events));
    exit();
} 
else {
    echo "<script>alert('กรุณากรอกค้นหา'); window.location.href = '/';</script>";
    exit();
}
?>
