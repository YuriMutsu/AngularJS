package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;

import com.example.demo.entity.OrderDetail;

public interface OrderDetailRepository extends CrudRepository<OrderDetail, Integer>{

}
