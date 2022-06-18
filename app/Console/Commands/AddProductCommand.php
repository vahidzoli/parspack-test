<?php

namespace App\Console\Commands;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AddProductCommand extends Command
{
    private $productRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:product {name?} {quantity?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $product)
    {
        parent::__construct();
        $this->productRepository = $product;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $data = array(
            'name'      => $this->argument('name') ?? Str::random(8),
            'quantity'  => $this->argument('quantity') ?? 0
        );
        
        $rules = array(
            'name'      => 'required|string|unique:products',
            'quantity'  => 'required|numeric'
        );
    
        $validator = Validator::make($data, $rules);
    
        if ($validator->fails()) {
            
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            };

        } else {
            $product = $this->productRepository->create($data);

            $this->info('product ' .$product->name. ' is Added.');
        }      
    }
}
