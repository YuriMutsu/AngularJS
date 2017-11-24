package com.example.demo.config;

import java.util.HashSet;

import com.example.demo.service.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.ApplicationListener;
import org.springframework.context.event.ContextRefreshedEvent;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Component;

import com.example.demo.entity.Role;
import com.example.demo.entity.User;
import com.example.demo.reponsitory.RoleRepository;

@Component
public class DataSeedingListener implements ApplicationListener<ContextRefreshedEvent> {

    @Autowired
    private UserService userService;

    @Autowired
    private RoleRepository roleRepository;

    @Autowired
    private PasswordEncoder passwordEncoder;

    @Override
    public void onApplicationEvent(ContextRefreshedEvent arg0) {
        // Roles
        if (roleRepository.findByName("ROLE_ADMIN") == null) {
            roleRepository.save(new Role("ROLE_ADMIN"));
        }

        if (roleRepository.findByName("ROLE_MEMBER") == null) {
            roleRepository.save(new Role("ROLE_MEMBER"));
        }

        // Admin account
        if (userService.findByUsername("admin") == null) {
            User admin = new User();
            admin.setUsername("admin");
            admin.setPassword(passwordEncoder.encode("123456"));
            admin.setEmail("admin@gmail.com");
            admin.setBirthday("04/09/1995");
            admin.setAddress("TP. HCM");
            admin.setPhone("0898133817");
            admin.setName("Administrator");
            admin.setGender("Male");
            HashSet<Role> roles = new HashSet<>();
            roles.add(roleRepository.findByName("ROLE_ADMIN"));
            roles.add(roleRepository.findByName("ROLE_MEMBER"));
            admin.setRoles(roles);
            userService.save(admin);
        }

        // Member account
        if (userService.findByUsername("member") == null) {
            User member = new User();
            member.setUsername("member");
            member.setPassword(passwordEncoder.encode("123456"));
            member.setEmail("member@gmail.com");
            member.setBirthday("04/09/1995");
            member.setAddress("TP. HCM");
            member.setPhone("0898133817");
            member.setName("Member");
            member.setGender("Male");
            HashSet<Role> roles = new HashSet<>();
            roles.add(roleRepository.findByName("ROLE_MEMBER"));
            member.setRoles(roles);
            userService.save(member);
        }
    }

}
