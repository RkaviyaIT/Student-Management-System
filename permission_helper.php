<?php
/**
 * Permission Helper
 * 
 * This file provides simple permission checking functions.
 * 
 * Permissions are loaded ONCE at login and stored in $_SESSION['permissions']
 * This makes checking permissions very fast - just an array check in memory,
 * NO database calls needed!
 * 
 * Example of what this solves:
 * ❌ BAD: Check database on every page load
 *   $sql = "SELECT permission FROM roles WHERE role_id = " . $_SESSION['user_id'];
 *   $result = query($sql); // SLOW - database hit every time
 * 
 * ✅ GOOD: Check permissions from memory (loaded at login)
 *   if (!hasPermission('edit_students')) { die("Access denied"); }
 *   // FAST - just array check, no database call
 */

/**
 * Check if current user has a specific permission
 * 
 * Usage:
 *   if (hasPermission('edit_students')) {
 *       // show edit button
 *   }
 */
function hasPermission($permission) {
    if (!isset($_SESSION['permissions'])) {
        return false;
    }
    return in_array($permission, $_SESSION['permissions']);
}

/**
 * Check if current user has ALL of the specified permissions
 * 
 * Usage:
 *   if (hasAllPermissions(['edit_students', 'delete_students'])) {
 *       // user has BOTH permissions
 *   }
 */
function hasAllPermissions($permissions) {
    if (!isset($_SESSION['permissions'])) {
        return false;
    }
    foreach ($permissions as $permission) {
        if (!in_array($permission, $_SESSION['permissions'])) {
            return false;
        }
    }
    return true;
}

/**
 * Check if current user has ANY of the specified permissions
 * 
 * Usage:
 *   if (hasAnyPermission(['edit_students', 'edit_teachers'])) {
 *       // user has AT LEAST ONE of these permissions
 *   }
 */
function hasAnyPermission($permissions) {
    if (!isset($_SESSION['permissions'])) {
        return false;
    }
    foreach ($permissions as $permission) {
        if (in_array($permission, $_SESSION['permissions'])) {
            return true;
        }
    }
    return false;
}

/**
 * Require permission - die if user doesn't have it
 * 
 * Usage:
 *   requirePermission('edit_students'); // dies if user doesn't have permission
 */
function requirePermission($permission) {
    if (!hasPermission($permission)) {
        die("Access Denied: You don't have permission to access this page.");
    }
}

/**
 * Get all permissions for current user
 * 
 * Usage:
 *   $allPerms = getAllPermissions();
 *   foreach ($allPerms as $perm) {
 *       echo $perm;
 *   }
 */
function getAllPermissions() {
    if (!isset($_SESSION['permissions'])) {
        return array();
    }
    return $_SESSION['permissions'];
}
?>
