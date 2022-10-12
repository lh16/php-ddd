<?php

/**
 * 领域模型
 * 地址   值对象
 * Class Address
 */
class Address{
    private $province;
    private $city;
    private $county;

}

/*
 * 区分实体和值对象的一个很重要的原则便是根据相等性来判断，实体对象的相等性是通过ID来完成的，对于两个实体，如果他们的所有属性均相同，但是ID不同，那么他们依然两个不同的实体，就像一对长得一模一样的双胞胎，他们依然是两个不同的自然人。对于值对象来说，相等性的判断是通过属性字段来完成的。比如，订单下的送货地址Address对象便是一个典型的值对象：
 *public class Address {
 private String province;
 private String city;
 private String detail;

 @Override
 public boolean equals(Object o) {
 if (this == o) {
 return true;
 }
 if (o == null || getClass() != o.getClass()) {
 return false;
 }
 Address address = (Address) o;
 return province.equals(address.province) &&
 city.equals(address.city) &&
 detail.equals(address.detail);
 }

 @Override
 public int hashCode() {
 return Objects.hash(province, city, detail);
 }
}
在Address的equals()方法中，通过判断Address所包含的所有属性(province，city，detail)来决定两个Address的相等性。
*/
