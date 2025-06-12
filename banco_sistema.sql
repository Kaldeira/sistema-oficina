drop database if exists sistema_oficina_preparacao;
create database sistema_oficina_preparacao;
use sistema_oficina_preparacao;

create table usuario (
idUsuario int auto_increment primary key,
login varchar(80) not null unique,
senha varchar(80) not null,
email varchar(120) not null,
nivel enum('admin', 'mecanico') not null default 'mecanico',
dataCadastro datetime default current_timestamp
);

create table mecanico (
idMecanico int auto_increment primary key,
nome varchar(80) not null,
telefone varchar(20) not null,
dataCadastro datetime default current_timestamp
);

create table cliente (
idCliente int auto_increment primary key,
nome varchar(80) not null,
telefone varchar(80) not null,
email varchar(120) not null,
cpf varchar(14) not null unique,
endereco varchar(200) not null,
dataCadastro datetime default current_timestamp
);

create table carro (
idCarro int auto_increment primary key,
idCliente int,
modelo varchar(120) not null,
fabricante varchar(40) not null,
ano smallint not null check (ano >= 1886),
placa varchar(80) not null unique,
cor varchar(50) not null,
caracteristicas TEXT,
imagem VARCHAR(255),
status ENUM('Manutencao', 'Finalizado') DEFAULT 'Manutencao',
dataCadastro datetime default current_timestamp,

foreign key (idCliente) references cliente(idCliente)
);

create table servico (
idServico int auto_increment primary key,
idMecanico int,
idCarro int,
descricao TEXT,
dataServico datetime default current_timestamp,

foreign key (idMecanico) references mecanico(idMecanico),
foreign key (idCarro) references carro(idCarro)
);

create table servico_item (
idItem int auto_increment primary key,
idServico int not null,
descricao varchar(255) not null,
valor decimal(10, 2) not null,

foreign key (idServico) references servico(idServico)
);

insert into usuario (login, senha, email, nivel) values
('admin', 'senha123', 'admin@admin.com', 'admin'),
('marcosmec', '1234', 'marcos@oficina.com', 'mecanico');

insert into mecanico (nome, telefone) values
('João da Silva', '11999998888');

insert into cliente (nome, telefone, email, cpf, endereco) values
('Carlos Souza', '11988887777', 'carlos@gmail.com', '123.456.789-00', 'Rua A, 123, São Paulo'),
('Ana Lima', '11977776666', 'ana.lima@hotmail.com', '987.654.321-00', 'Av. B, 456, São Paulo');

insert into carro (idCliente, modelo, fabricante, ano, placa, cor, caracteristicas, imagem, status) values
(1, 'Civic EXL', 'Honda', 2020, 'ABC1D23', 'Prata', 'Troca de Óleo e Alinhamento', 'civic2020.jpg', 'Finalizado'),
(2, 'Onix LTZ', 'Chevrolet', 2019, 'XYZ9Z99', 'Preto', 'Problema no cambio', 'onix2019.jpg', 'Manutencao'),
(1, 'Golf GTI', 'Volkswagen', 2018, 'GTI2025', 'Vermelho', 'Fazer Stage 2', 'golfgti2018.jpg', 'Manutencao');

insert into servico (idMecanico, idCarro, dataServico, descricao) values
(1, 1, '2025-05-10 08:30:00', 'Troca de pastilhas de freio dianteiras, alinhamento e balanceamento realizados.');

insert into servico_item (idServico, descricao, valor) values
(1, 'Troca de pastilhas de freio dianteiras', 300.00),
(1, 'Alinhamento', 150.00),
(1, 'Balanceamento', 100.00),
(1, 'Mão de obra', 300.00);


select * from carro;	
select * from servico;

select s.descricao,
s.dataServico,

si.idItem,
si.descricao,
si.valor,
si.idServico,

c.idCarro,
c.modelo,
c.placa,

cli.nome,
cli.cpf,
cli.telefone

from servico s
inner join carro c on s.idCarro = c.idCarro
inner join cliente cli on c.idCliente = cli.idCliente
left join servico_item si on s.idServico = si.idServico;

select s.descricao,
s.dataServico,


c.modelo,
c.placa,

cli.nome,

mec.nome as mecanico

from servico s
inner join carro c on s.idCarro = c.idCarro
inner join cliente cli on c.idCliente = cli.idCliente
inner join mecanico mec on s.idMecanico = mec.idMecanico;