# Basket

The homepage of the tutorial: 

http://docs.getprooph.org/tutorial/event_sourcing_basics.html


The file structure of the project:
```
|_ Basket
| |_ scripts
| |_ src
| | |_ Infrastructure
| | | |_ Prooph
| | |_ Model
| | | |_ Basket
| | | |_ Command
| | | |_ Event
| | | |_ ERP
| | | |_ Exception
| | |_ Projection
| |   |_ Query
| |_ tests
|    |_Model
|_ scripts
```

The first step is install composer dependencies:
```bash
composer install
```

### Business rules:
    
 - A shopping session starts with an empty basket.
 - Each shopping session is assigned its own basket.
 - A product can only be added to a basket if at least one product is available in stock.
 - Product quantity in a basket must not be higher than available stock.
 - If stock is reduced by a checkout, product quantity in currently active baskets needs to be checked and conflicts resolved.
 - If product quantity in a basket is reduced to zero or less the product is removed from the basket.
 - A checkout can only be made if no unresolved quantity-stock-conflicts exist for the basket.
