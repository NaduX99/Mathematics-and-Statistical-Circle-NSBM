<?php
    include 'config.php';
    // Update category: if date < today and category is upcoming → set to past
    $sql = "UPDATE events SET category = 'past' WHERE date < CURDATE() AND category = 'upcoming'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $all_articles = $pdo->query('SELECT * FROM news ORDER BY publish_date DESC')->fetchAll();
    $news_categories = [ ];
    foreach ( $all_articles as $article ) { $news_categories [ $article [ 'category' ] ] [ ] = $article;}

    // ----------------------------
    // Fetch Upcoming Events
    // ----------------------------
    $sqlUpcoming = "SELECT id, title, description, date, category, image, created_at 
                    FROM events 
                    WHERE category = 'upcoming' 
                    ORDER BY date ASC";
    $stmt = $pdo->prepare($sqlUpcoming);
    $stmt->execute();
    $upcomingEvents = $stmt->fetchAll();
    if (!$upcomingEvents) { $upcomingEvents = []; }
    
    // ----------------------------
    // Fetch Past Events
    // ----------------------------
    $sqlPast = "SELECT id, title, description, date, category, image, created_at 
                FROM events 
                WHERE category = 'past' 
                ORDER BY date DESC";
    $stmt = $pdo->prepare($sqlPast);
    $stmt->execute();
    $pastEvents = $stmt->fetchAll();
    if (!$pastEvents) { $pastEvents = []; }

    function log_activity(PDO $pdo, string $type, ?int $entity_id, string $action, string $entity_title, $details = null): void{
        $actor = $_SESSION['admin_username'] ?? null;

        $sql = 'INSERT INTO activity_log (actor, entity_type, entity_id, entity_title, action, details)
                VALUES (?,?,?,?,?,?)';
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $actor, $type, $entity_id, $entity_title, $action,
            $details !== null ? json_encode($details, JSON_UNESCAPED_UNICODE) : null
        ]);
    }

    $eventCount  = ($pdo->query('SELECT COUNT(*) AS c FROM events')->fetch()['c'] ?? 0);
    $newsCount  = ($pdo->query('SELECT COUNT(*) AS c FROM news')->fetch()['c'] ?? 0);

    $activities = $pdo->query("
    SELECT id, actor, entity_type, entity_id, entity_title, action, details, created_at
    FROM activity_log
    ORDER BY created_at DESC
    LIMIT 8
    ")->fetchAll();

    function activity_icon(array $a): string {
        $t = $a['entity_type']; $act = $a['action'];
        if ($t === 'event') {
            return match($act) {
            'create' => 'fas fa-calendar-plus',
            'update' => 'fas fa-user-edit',
            'delete' => 'fas fa-trash',
            default => 'fas fa-calendar-alt',
            };
        } 
        else { // news
            return match($act) {
            'create' => 'fas fa-images',
            'update' => 'fas fa-pen',
            'delete' => 'fas fa-trash',
            default => 'fas fa-sliders-h',
            };
        }
    }

    function time_ago(string $ts): string {
    $d = new DateTime($ts);
    $now = new DateTime('now', new DateTimeZone('Asia/Colombo'));
    $diff = $now->getTimestamp() - $d->getTimestamp();
    if ($diff < 60) return $diff . ' sec ago';
    if ($diff < 3600) return floor($diff/60) . ' min ago';
    if ($diff < 86400) return floor($diff/3600) . ' hours ago';
    if ($diff < 7*86400) return floor($diff/86400) . ' days ago';
    return $d->format('Y-m-d H:i');
    }

    // Fetch all event titles
    $stmt = $pdo->query("SELECT id, title FROM events ORDER BY title ASC");
    $events = $stmt->fetchAll();
?>