package com.example.demo.reponsitory;

import org.springframework.data.repository.CrudRepository;
import com.example.demo.entity.Role;

public interface RoleRepository extends CrudRepository<Role, Integer> {
	 Role findByName(String name);
}
