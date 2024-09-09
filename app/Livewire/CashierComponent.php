<?php

namespace App\Livewire;

use Filament\Forms;
use App\Models\Product;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

class CashierComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public $code;
    public $product;
    public $price;
    public $quantity = 0;
    public $subtotal;
    public $discount = 0;
    public $total = 0;
    public $products = [];
    public $addProducts= [];
    public $product_id;

    public function render()
    {
        return view('livewire.cashier-component');
    }

    public function form(Form $form)
    {
        return $form->schema([
            Forms\Components\Grid::make(3)->schema([

                // Left Column: Input Section
                Forms\Components\Grid::make()->schema([ 
                    Forms\Components\TextInput::make('code')
                    ->label('Product Code')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Fetch the product by code
                        $product = Product::where('code', $state)->first();
                
                        if (!$product) {
                            // Form error if the product is not found
                            $set('product', null);
                            Notification::make('error')->title('Product Not Found')->body('Produk dengan kode '.$state. ' Tidak ada !!!!')->danger()->send();
                        } else {
                            // Set the product and price fields if the product is found
                            $set('product', $product->id);
                            $set('price', $product->price);
                            $this->calculateSubtotal();
                        }
                    }),

                    Forms\Components\Select::make('product')
                        ->label('Select Product')
                        ->options(fn() => collect(Product::where('active', 1)->get())->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn($state,$set) => $this->product_id = $state),

                    Forms\Components\TextInput::make('quantity')
                        ->label('Quantity')
                        ->numeric()
                        ->default(1)
                        ->required()
                        ->live()
                        ->afterStateUpdated(function($state, callable $set){
                            $product = $this->getProductId($this->product_id);
                            $productPrice = ceil($product?->price * $state); // sub total harga produk x qty.
                            $this->addProducts[] = [
                                'name' => $product->name,
                                'qty' => $state,
                                'subtotal' => $productPrice
                            ];
                            $this->updateKeyValue();
                            $this->resetForm();

                        }),

                  
                    
                   /// Products Table Section
                    Forms\Components\KeyValue::make('products')
                        ->label('Added Products')
                        ->keyLabel('Nama Produk')
                        ->valueLabel('Details')
                        ->columnSpan(3)
                ])->columnSpan(2), // Ensure left side gets two-thirds of the space

                // Right Column: Transaction Details
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('price')
                        ->label('Price')
                        ->disabled()
                        ->required(),
                    Forms\Components\TextInput::make('subtotal')
                        ->label('Subtotal')
                        ->disabled()
                        ->required(),
                    Forms\Components\TextInput::make('discount')
                        ->label('Discount')
                        ->numeric()
                        ->default(0)
                        ->required()
                        ->afterStateUpdated(fn($state, callable $set) => $this->calculateTotal()),
                    Forms\Components\TextInput::make('total')
                        ->label('Total')
                        ->disabled()
                        ->required(),
                ])->columnSpan(1), // Right side will get one-third of the space
            ]),
        ]);
    }

    public function getProductId($id)
    {
        $product = Product::find($id);
        if(!$product)
        {
            Notification::make('error')->title('Not Found')->body('Produk tidak tersedia')->danger()->send();
            return (Object)[];
        }else{

            return $product;
        }
    }

    public function updatePrice()
    {
        $product = Product::find($this->product);
        $this->price = $product->price ?? 0;
        $this->calculateSubtotal();
    }

    public function calculateSubtotal()
    {
        // Calculate the subtotal based on selected product and quantity
        $this->subtotal = $this->quantity * $this->price;
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        // Calculate total after discount
        $this->total = $this->subtotal - $this->discount;
    }

    public function addProduct()
    {
        // Add product to the list
        $product = Product::find($this->product);

        if ($product) {
            $this->addProducts[] = [
                'name' => $product->name,
                'quantity' => $this->quantity,
                'subtotal' => $this->subtotal,
            ];

            // Update the KeyValue component
            $this->updateKeyValue();

            // Reset form fields
            $this->resetForm();
        }
    }

    public function updateKeyValue()
    {
        // You can customize how products are shown in the KeyValue
      //  dd($this->products);
        $this->products = collect($this->addProducts)->mapWithKeys(function ($product) {
            return [$product['name'] => 'Quantity: ' . $product['qty'] . ', Subtotal: ' . $product['subtotal']];
        })->toArray();
    }

    public function resetForm()
    {
        $this->code = '';
        $this->product = null;
        $this->quantity = 1;
        $this->price = 0;
        $this->subtotal = 0;
    }
}
