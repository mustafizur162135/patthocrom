<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define permissions for admin, student, and teacher guards
        $adminPermissions = [
            'admin.users.list',
            'admin.users.view',
            'admin.users.edit',
            'admin.users.store',
            'admin.users.create',
            'admin.users.update',
            'admin.users.delete',
            'api.role-permission.index',
            'api.role-permission.store',
            'question_types.index', // Add this line
            'question_types.create', // Add this line
            'question_types.store', // Add this line
            'question_types.show', // Add this line
            'question_types.edit', // Add this line
            'question_types.update', // Add this line
            'question_types.destroy', // Add this line
            'question_import.show', // Add this line
            'question_import.create', // Add this line
            'question_export.downloade', // Add this line
            'question.list', // Add this line
            'question.view', // Add this line
            'question.create', // Add this line
            'question.store', // Add this line
            'question.edit', // Add this line
            'question.update', // Add this line
            'question.destroy', // Add this line

        ];

        $studentPermissions = [
            'student.list', 'student.view', 'student.create', 'student.update', 'student.delete', 'exam_hall.list', 'exam_hall.view', 'exam_hall.create', 'exam_hall.update', 'exam_hall.delete', 'notebook.list', 'notebook.view', 'notebook.create', 'notebook.update', 'notebook.delete', 'result.list', 'result.view', 'result.create', 'result.update', 'result.delete',
        ];

        $teacherPermissions = [
            'teacher.list', 'teacher.view', 'teacher.create', 'teacher.update', 'teacher.delete',
        ];

        // Create permissions for each guard
        $this->createPermissions($adminPermissions, 'admin');
        $this->createPermissions($studentPermissions, 'student');
        $this->createPermissions($teacherPermissions, 'teacher');

        // Create roles for each guardss
        $adminRole = $this->createRole('admin');
        $studentRole = $this->createRole('student');
        $teacherRole = $this->createRole('teacher');

        // Assign permissions to roles for each guard
        $this->assignPermissionsToRole($adminRole, $adminPermissions);
        $this->assignPermissionsToRole($studentRole, $studentPermissions);
        $this->assignPermissionsToRole($teacherRole, $teacherPermissions);

        // Create and assign roles to users
        $this->createAndAssignUser('Admin', 'admin@admin.com', 'password', $adminRole, 'admin');
        $this->createAndAssignUser('user', 'user@user.com', 'password', $studentRole, 'student');
        $this->createAndAssignUser('student', 'student@student.com', 'password', $studentRole, 'student');
        $this->createAndAssignUser('teacher', 'teacher@teacher.com', 'password', $teacherRole, 'teacher');
    }

    private function createPermissions(array $permissions, string $guardName)
    {
        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => $guardName, 'name' => $permission]);
        }
    }

    private function createRole(string $guardName): Role
    {
        return Role::create(['name' => $guardName, 'guard_name' => $guardName]);
    }

    private function assignPermissionsToRole(Role $role, array $permissions)
    {
        $role->givePermissionTo($permissions);
    }

    private function createAndAssignUser(string $name, string $email, string $password, Role $role, string $guardName)
    {
        $userModel = $this->getUserModelForGuard($guardName);
        $user = $userModel::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $user->assignRole($role);
    }

    private function getUserModelForGuard(string $guardName)
    {
        switch ($guardName) {
            case 'admin':
                return Admin::class;
            case 'student':
                return Student::class;
            case 'teacher':
                return Teacher::class;
            default:
                return Admin::class; // Default to Admin model
        }
    }
}
