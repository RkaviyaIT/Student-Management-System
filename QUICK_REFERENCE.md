# QUICK REFERENCE - Optimizations

## Files You Created/Modified

```
✅ permission_helper.php (NEW)        - Helper functions for permission checking
✅ OPTIMIZATION_GUIDE.md (NEW)       - Detailed explanation
✅ optimization_demo.html (NEW)      - Visual demo (open in browser)
✅ OPTIMIZATIONS_SUMMARY.md (NEW)    - This summary

✏️ setup.sql (MODIFIED)              - Added indexes
✏️ login_check.php (MODIFIED)        - Added permission loading
✏️ view_student.php (MODIFIED)       - Uses permissions + shows index usage
```

---

## What Each File Does

| File | Purpose | Key Line |
|------|---------|----------|
| permission_helper.php | Functions to check permissions | Use `hasPermission()` on any page |
| login_check.php | Loads permissions at login | Line 35: `getPermissionsForUser()` |
| view_student.php | Checks permission before showing | Line 13: `requirePermission()` |
| setup.sql | Database indexes for speed | Line with `idx_student_search` |

---

## Copy-Paste Code for Any Page

### To Check Permissions

```php
<?php
include 'permission_helper.php';

// Check if user has permission
if (hasPermission('edit_students')) {
    // Show edit button
    echo "<a href='edit.php'>Edit</a>";
}
?>
```

### To Block Entire Page

```php
<?php
include 'permission_helper.php';

// This page requires the permission
requirePermission('edit_students');

// Code below only runs if user has permission
?>
```

---

## 3-Sentence Interview Answer

> "I added database indexing for student search to make queries fast - instead of scanning all rows, MySQL jumps directly to matching records. Second, I load user permissions once at login into the session, then check them from memory on every page instead of hitting the database each time. Both are simple optimizations with real performance benefits."

---

## Available Permissions

```
view_students        - Can see student list
edit_students        - Can edit students
delete_students      - Can delete students
view_teachers        - Can see teacher list
edit_teachers        - Can edit teachers
view_classes         - Can see classes
edit_classes         - Can edit classes
view_subjects        - Can see subjects
edit_subjects        - Can edit subjects
view_materials       - Can see materials
upload_materials     - Can upload materials
view_reports         - Can see reports
```

---

## Test It

1. **Database indexes:** Check [setup.sql](setup.sql) line with `idx_student_search`
2. **Permission loading:** Check [login_check.php](login_check.php) line 35
3. **Permission checking:** Open [view_student.php](view_student.php) line 13

---

## For Interview

1. Memorize: **Indexing** + **Permission Caching**
2. Explain: How each one saves time
3. Show: Point to the code files
4. Practice: Say it 3 times before interview

---

**You're ready! 🚀**
