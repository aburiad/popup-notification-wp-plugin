<?php
// WordPress এর মূল ফাইল লোড করা
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

// সার্চ ইনপুট চেক করা
if (isset($_GET['search'])) {
    $search = $_GET['search']; // ইনপুট নিরাপদ করা

    // পেজ খোঁজা সার্চ ইনপুটের ভিত্তিতে
    $pages = get_pages(array(
        'post_type' => 'page',
        's' => $search // WordPress এর 's' প্যারামিটার দিয়ে সার্চ
    ));

    // ফলাফল তৈরী করা
    $results = [];
    foreach ($pages as $page) {
        $results[] = [
            'id' => $page->post_title, // পেজের ID
            'text' => $page->post_title // পেজের টাইটেল
        ];
    }

    // JSON আকারে রিটার্ন করা
    echo json_encode($results);

} else {
    // যদি সার্চ ইনপুট না থাকে, খালি রিটার্ন করা
    echo json_encode([]);
}
?>
