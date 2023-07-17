<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;
    public $selected_id;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc');
        $this->setSecondaryHeaderTdAttributes(function(Column $column, $rows) {
            if ($column->isField('name')) {
                return ['default' => true,'class' => 'bg-primary'];
            }
        });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->isHidden(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make('Role Author', 'user_type')
                ->view('admin.users.user-type'),
            Column::make("Role Admin", 'id')
                ->format(function($value, $column, $row) {
                    foreach ($column->getRoleNames() as $role){
                        $roleName = ucwords($role);
                    }
                    return "<a href=\"#\" class=\"badge rounded-pill bg-label-primary\">$roleName</a>";
                })->html(),
            Column::make("Status", "status")
                ->format(function($value, $column, $row) {
                    if($column->status == 1){
                        $status = "<div class=\"avatar avatar-sm me-2\">
                            <a type=\"button\" wire:click=\"statusModal( $column->id )\">
                                <div class=\"avatar-initial rounded-circle bg-label-success\">
                                    <i class=\"avatar-icon fa fa-check font-medium-2\"></i>
                                </div>
                            </a>
                        </div>";
                    }else{
                        $status = "<div class=\"avatar avatar-sm me-2\">
                            <a type=\"button\" wire:click=\"statusModal($column->id)\">
                                <div class=\"avatar-initial rounded-circle bg-label-danger\">
                                    <i class=\"avatar-icon fa fa-ban font-medium-2\"></i>
                                </div>
                            </a>
                        </div>";
                    }

                    return $status;
                })->html(),
            Column::make('Actions', 'id')
                ->view('admin.users.action'),

        ];
    }
    public array $bulkActions = [
        'resetPassword' => 'Reset Password',
        'confirmDeleteSelected' => 'Delete'
    ];

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = User::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function confirmResetPassword($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalResetPassword');
    }

    public function resetPassword()
    {
        try {
            $default_password = '12345678';
            $user = User::whereIn('id', $this->getSelected())->update([
                'password' => Hash::make($default_password)
            ]);

            // $email_data = array(
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'password' => $default_password,
            // );

            // Mail::send('admin.users.welcome_email', $email_data, function ($message) use ($email_data) {
            //     $message->to($email_data['email'], $email_data['name'])
            //         ->subject('Reset Password Akun CMS Ditjen Bimashindu Kementerian Agama')
            //         ->from(config('app.email'), config('app.name'));
            // });


            session()->flash('message', 'Password berhasil direset 😊, cek email untuk infomasi password terbaru.');
            $this->dispatchBrowserEvent('closeModalResetPassword');
            $this->dispatchBrowserEvent('openModalResetPasswordSuccess');

        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            $this->dispatchBrowserEvent('closeModalResetPassword');
            $this->dispatchBrowserEvent('openModalResetPasswordSuccess');
        }

    }

    public function confirmDeleteSelected()
    {
        $this->selected_id = $this->getSelected();
        $this->dispatchBrowserEvent('openModalDeleteSelected');
    }

    public function deleteSelected()
    {
        try {
            $users = User::whereIn('id', $this->selected_id)->delete();

            session()->flash('message', 'Data user berhasil dihapus.');
            $this->dispatchBrowserEvent('closeModalDeleteSelected');

        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            $this->dispatchBrowserEvent('closeModalDeleteSelected');
        }

    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = User::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function customView(): string
    {
        return 'admin.users.modal';
    }
}
