# Run project  
You should have Docker

- clone project
```
bash: git clone https://github.com/v-e-y/RemotEmployees.git
bash: git checkout dev
```

- run next commands
```
bash: composer install
bash: sail up -d
bash: sail artisan migrate:fresh --seed
```
- open your browser. Website wil`be available on address - http://localhost:8000/

- Tests
```
bash: sail artisan test
```


![tests](./tests.png)  

Add lot page  

![add lot page](./add-lot-page.png)  

Edit lot page  

![edit lot page](./edit-lot-page.png)

Product page  

![Product page](./product-page.png)

Add category page  

![edit lot page](./add-category-page.png)  

Category page

![Category page](./category-page.png)

Edit category page  

![edit lot page](./edit-category-page.png)

