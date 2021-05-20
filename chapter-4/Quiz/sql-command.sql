
CREATE DATABASE ch4;

use ch4;

CREATE TABLE `class`(
    `cls_id` INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    `cls_name` VARCHAR(255) NOT NULL,
    `cls_year` INT NOT NULL
);
CREATE TABLE `student`(
    `stu_id` INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    `stu_name` VARCHAR(255) NOT NULL,
    `stu_gender` VARCHAR(255) NOT NULL,
    `cls_id` INT UNSIGNED NOT NULL
);
ALTER TABLE
    `student` ADD CONSTRAINT `student_class_id_foreign` FOREIGN KEY(`cls_id`) REFERENCES `class`(`cls_id`);

CREATE TABLE `course`(
    `course_id` INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
    `course_name` VARCHAR(255) NOT NULL,
    `course_score` INT NOT NULL
);
CREATE TABLE `selection`(
    `stu_id` INT UNSIGNED NOT NULL ,
    `course_id` INT UNSIGNED NOT NULL,
    unique(stu_id,course_id)
);
ALTER TABLE
    `selection` ADD CONSTRAINT `selection_stu_id_foreign` FOREIGN KEY(`stu_id`) REFERENCES `student`(`stu_id`);
ALTER TABLE
    `selection` ADD CONSTRAINT `selection_course_id_foreign` FOREIGN KEY(`course_id`) REFERENCES `course`(`course_id`);

INSERT INTO `class` (`cls_id`, `cls_name`, `cls_year`) VALUES 
(NULL, '甲班', '107'), 
(NULL, '乙班', '107'), 
(NULL, '丙班', '107'), 
(NULL, '甲班', '108'), 
(NULL, '乙班', '108'), 
(NULL, '丙班', '108');

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_gender`, `cls_id`) VALUES
('1106104230', '曾桃燕', '女', '2'), 
('1106104125', '張德開', '男', '1'), 
('1107104250', '梅梁欣', '女', '5'), 
('1107104311', '金大偉', '男', '6');

INSERT INTO `course` (`course_id`, `course_name`, `course_score`) VALUES
(NULL, '電路學', '3'), 
(NULL, '物理', '3'), 
(NULL, '計算機概論', '3'), 
(NULL, '數位邏輯', '3'),
(NULL, '實用英文', '2'),
(NULL, '微積分', '3'),
(NULL, '物理實驗', '1'),
(NULL, '電子學實習', '1'),
(NULL, '工程數學', '3');