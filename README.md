# princing-comparison

Dental Price Comparison

1. Develop a model for a dental price comparison.

2. Find the best supplier for a customer and calculate the best price.

3. The customer will input the Product Type and the requested amount.

4. An order cannot be split between suppliers.

5. No database implementation is required, data is already loaded in “memory”, you can
use hard coded values.

6. Please implement the solution in PHP. You may use any framework.

Supplier A
Dental Floss 1 Unit 9,00 EUR
Dental Floss 20 Units 160,00 EUR
Ibuprofen 1 Unit 5,00 EUR
Ibuprofen 10 Units 48,00 EUR

Supplier B
Dental Floss 1 Unit 8,00 EUR
Dental Floss 10 Units 71,00 EUR
Ibuprofen 1 Unit 6,00 EUR
Ibuprofen 5 Units 25,00 EUR
Ibuprofen 100 Units 410,00 EUR

Example 1
    Customer wants to buy 5 Units Dental Floss and 12 Units Ibuprofen.
    Cost Supplier A:
    5 x 1 Unit Dental Floss - 45 EUR
    1 x 10 Units Ibuprofen - 48 EUR
    2 x 1 Unit Ibuprofen - 10 EUR
    Total: 103 EUR

    Cost Supplier B:
    5 x 1 Unit Dental Floss - 40 EUR
    2 x 5 Units Ibuprofen - 50 EUR
    2 x 1 Unit Ibuprofen - 12 EUR
    Total: 102 EUR
    
    Result: Supplier B is cheaper - 102 EUR

Example 2
    Customer wants to buy 105 Units Ibuprofen
    Cost Supplier A:
    10 x 10 Units Ibuprofen - 480 EUR
    5 x 1 Unit Ibuprofen - 25 EUR
    Total: 505 EUR

    Cost Supplier B:
    1 x 100 Units Ibuprofen - 410 EUR
    1 x 5 Units Ibuprofen - 25 EUR
    Total: 435 EUR

    Result: Supplier B is cheaper - 435 EUR