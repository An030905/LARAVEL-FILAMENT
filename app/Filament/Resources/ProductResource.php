<?php

namespace App\Filament\Resources; // Đã sửa Namespace cho đúng vị trí mới

use App\Filament\Resources\Pages\CreateProduct;
use App\Filament\Resources\Pages\EditProduct;
use App\Filament\Resources\Pages\ListProducts;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    // Sửa lỗi Type hint cho icon
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $slug = '23810310263-products';

    protected static ?string $navigationLabel = 'Sản phẩm';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Thông tin cơ bản')
                    ->description('Nhập các thông tin chính của sản phẩm tại đây.')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Danh mục'),

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Tên sản phẩm')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->label('Slug (MSSV: 23810310263)')
                            ->readOnly(),
                    ])->columns(2),

                Section::make('Chi tiết & Giá cả')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull()
                            ->label('Mô tả sản phẩm'),

                        Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->minValue(0)
                                    ->prefix('VND')
                                    ->required()
                                    ->label('Giá bán'),

                                Forms\Components\TextInput::make('stock_quantity')
                                    ->numeric()
                                    ->integer()
                                    ->minValue(0)
                                    ->required()
                                    ->label('Số lượng tồn'),

                                Forms\Components\TextInput::make('discount_percent')
                                    ->label('Giảm giá (%)')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->maxValue(100),
                            ]),

                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('sv23810310263-products')
                            ->label('Ảnh đại diện'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Bản nháp',
                                'published' => 'Đã đăng',
                                'out_of_stock' => 'Hết hàng',
                            ])
                            ->default('draft')
                            ->required()
                            ->label('Trạng thái'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->disk('public')
                    ->label('Ảnh'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Tên sản phẩm'),

                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.') . ' ₫')
                    ->sortable()
                    ->label('Giá'),

                Tables\Columns\TextColumn::make('stock_quantity')
                    ->numeric()
                    ->label('Kho'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Danh mục'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Lọc theo danh mục'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
{
    return [
        'index' => ListProducts::route('/'), // Xóa Pages\
        'create' => CreateProduct::route('/create'), // Xóa Pages\
        'edit' => EditProduct::route('/{record}/edit'), // Xóa Pages\
    ];
}
}


