<?php
function mark_all_as_done()
{
    $get_all_tasks_query = "SELECT id FROM tasks WHERE done = 0;";
    $response = $GLOBALS['conn']->query($get_all_tasks_query);
    if ($response && $response->num_rows > 0) {
        $update_statement = $GLOBALS['conn']->prepare("UPDATE tasks SET done = 1 WHERE id = ?");
        while ($row = $response->fetch_assoc()) {
            $id = $row['id'];
            if ($update_statement) {
                $update_statement->bind_param("s", $id);
                if (!$update_statement->execute()) {
                    echo 'Error executing MySQL update statement: ' . $update_statement->error;
                }
            }
        }
        $update_statement->close();
    }
}
?>
