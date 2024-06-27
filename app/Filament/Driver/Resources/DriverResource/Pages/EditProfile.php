<?php

namespace App\Filament\Driver\Resources\DriverResource\Pages;


use Filament\Forms\Components\Button;
use Illuminate\Support\Facades\Redirect;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
 
class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                TextInput::make('last_name')
                ->required()
                ->maxLength(255),
                $this->getEmailFormComponent(),
                TextInput::make('telephone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('adress')
                    ->required()
                    ->maxLength(255),
                TextInput::make('document')
                    ->required()
                    ->maxLength(255),
                Toggle::make('document_verify')
                ->required()
                ->disabled(),
                FileUpload::make('photo_licence')
                    ->image(),
                FileUpload::make('image')
                    ->image(),

                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }


}