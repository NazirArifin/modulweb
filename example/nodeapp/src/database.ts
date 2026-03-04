import { Sequelize, DataTypes, Model } from 'sequelize';

const sequelize = new Sequelize('database', 'username', 'password', {
  host: 'localhost',
  dialect: 'mariadb',
  logging: false
});

interface UserAttributes {
  id?: number;
  email: string;
  password: string;
}

class User extends Model<UserAttributes> implements UserAttributes {
  public id!: number;
  public email!: string;
  public password!: string;
}

User.init({
  email: { type: DataTypes.STRING, unique: true, allowNull: false },
  password: { type: DataTypes.STRING, allowNull: false }
}, { sequelize, modelName: 'user' });

interface MahasiswaAttributes {
  id?: number;
  nama: string;
  npm: string;
}

class Mahasiswa extends Model<MahasiswaAttributes> implements MahasiswaAttributes {
  public id!: number;
  public nama!: string;
  public npm!: string;
}

Mahasiswa.init({
  nama: { type: DataTypes.STRING, allowNull: false },
  npm: { type: DataTypes.STRING, unique: true, allowNull: false }
}, { sequelize, modelName: 'mahasiswa' });

export { sequelize, User, Mahasiswa };
