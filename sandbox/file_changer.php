<?php
echo fileowner('file_permissions.php');
echo "<br />";
// if we have Posix installed
$owner_id = fileowner('file_permissions.php');
$owner_array = posix_getpwuid($owner_id);
echo $owner_array['name'];
echo "<br />";

// chown('file_permissions.php', 'mark');
// chown only works if PHP is superuser
// making webserver/PHP a superuser is a big security issue

echo substr(decoct(fileperms('file_permissions.php')), 2);
echo "<br />";
chmod('file_permissions.php', 0444);
echo substr(decoct(fileperms('file_permissions.php')), 2);
echo "<br />";

echo is_readable('file_permissions.php') ? 'yes' : 'no';
echo "<br />";
echo is_writable('file_permissions.php') ? 'yes' : 'no';
echo "<br />";
?>
