use Illuminate\Support\Facades\Gate;

public function boot()
{
    Gate::define('admin-only', function ($user) {
        return $user->username === 'admin_cafesur';
    });
}
