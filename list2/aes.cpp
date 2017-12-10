#include <iostream>
#include <thread>
#include <bitset>
#include <openssl/conf.h>
#include <openssl/evp.h>
#include <openssl/err.h>
#include <string.h>
#include <assert.h>

using namespace std;

void hex_to_byte(unsigned char* out, string value, int right_shift);
size_t calcDecodeLength(const char* b64input);
int Base64Decode(const char* b64message, unsigned char** buffer, size_t* length);
int decrypt(unsigned char* key, unsigned char* plaintext);
bool check_plaintext(unsigned char* plaintext, int length);
void fred(int start);

unsigned char* iv = new unsigned char[16];
unsigned char* ciphertext = new unsigned char[1024];
size_t ciphertext_len;
string Key = "96f5fa8803a40e8d29e57f02d1ec50e6e233a3e276789c3b4e215fc5d5df1348";

int main(int argc, char const *argv[]) {
  /* code */

  // this array should be byte array
  //unsigned char* key = new unsigned char[32];
  //string Key = "8803a40e8d29e57f02d1ec50e6e233a3e276789c3b4e215fc5d5df1348";
  string Iv = "acaf48fede178fd9575600c8682406fc";
  const char* kryptoBase64 = "W80Uov23U7df3ZN7tet2bghYbJJxF0XoKuURy8CgcjPgN+XbEYimlpfjwlNqbipLNLKvVG7yqzEGXn8TbeZAI+sW1ns4IXRSoFxdQGZ37nm7wgT2BvUQnYXHzc5TREkmU74nFVEIJM7873yY3mO2mhnWci8lM8NIADCiOnUpcjpOG4BBuV0vN7tGuO/57+51jlnUQmHHZnCxa/O+KrOWR7DHS+3G0BPQVveLM2Wn+mIRMR4Cv8JePCv5kHYBY7Vd";

  // decode ciphertext from base64
  Base64Decode(kryptoBase64, &ciphertext, &ciphertext_len);

  // copy  iv from string to byte array
  hex_to_byte(iv, Iv,0);

	unsigned char* key = new unsigned char[32];
	hex_to_byte(key, Key, 0);

	unsigned char* plaintext = new unsigned char[256];
  int plaintext_len;

  plaintext_len = decrypt(key, plaintext);

	cout << plaintext << "  " << plaintext_len <<"\n";
  return 0;
}

void hex_to_byte(unsigned char* out, string value, int right_shift) {
  unsigned char lut[16] = {'0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'};

  if (((value.length()+right_shift) % 2) == 1) throw invalid_argument("odd length");
  size_t i = 0;
	if ((value.length() % 2) == 1) {
		char a = value[i];
    unsigned char* p = lower_bound(lut, lut + 16, a);
		out[right_shift/2] = (((p - lut)));
		i++;
	}

  for (i ; i < value.length(); i += 2) {
    char a = value[i];
    unsigned char* p = lower_bound(lut, lut + 16, a);
    char b = value[i + 1];
    unsigned char* q = lower_bound(lut, lut + 16, b);
    out[(i+right_shift)/2] = (((p - lut) << 4) | (q - lut));
  }
}

size_t calcDecodeLength(const char* b64input) { //Calculates the length of a decoded string
	size_t len = strlen(b64input),
		padding = 0;

	if (b64input[len-1] == '=' && b64input[len-2] == '=') //last two chars are =
		padding = 2;
	else if (b64input[len-1] == '=') //last char is =
		padding = 1;

	return (len*3)/4 - padding;
}

int Base64Decode(const char* b64message, unsigned char** buffer, size_t* length) {
  BIO *bio, *b64;

  int decodeLen = calcDecodeLength(b64message);
  *buffer = (unsigned char*)malloc(decodeLen + 1);
  (*buffer)[decodeLen] = '\0';
  bio = BIO_new_mem_buf(b64message, -1);
  b64 = BIO_new(BIO_f_base64());
  bio = BIO_push(b64, bio);

  BIO_set_flags(bio, BIO_FLAGS_BASE64_NO_NL); //Do not use newlines to flush buffer
  *length = BIO_read(bio, *buffer, strlen(b64message));
  assert(*length == decodeLen); //length should equal decodeLen, else something went horribly wrong
  BIO_free_all(bio);

  return (0); //success
}

int decrypt(unsigned char* key, unsigned char* plaintext) {
  EVP_CIPHER_CTX *ctx;
  ctx = EVP_CIPHER_CTX_new();

  int len = 0;
  int lastDecryptLength = 0;
  int plaintext_len = 0;

  EVP_DecryptInit_ex(ctx, EVP_aes_256_cbc(),NULL, key, iv);

  EVP_DecryptUpdate(ctx, plaintext, &len, ciphertext, ciphertext_len);
  plaintext_len += len;

  EVP_DecryptFinal_ex(ctx, plaintext + len, &lastDecryptLength);
  plaintext_len += lastDecryptLength;

  EVP_CIPHER_CTX_free(ctx);
  plaintext[plaintext_len-1] = '\0';
  return plaintext_len;
}

bool check_plaintext(unsigned char* plaintext, int length) {
	int count = 0;
  int i = 0;
	for (i ; i < length; i++) {
		if(isprint(plaintext[i])) {
      count ++;
    }
	}
  return 10*count > 8*length ? true : false;
}

void fred(int start) {

  unsigned char* key = new unsigned char[32];
  hex_to_byte(key, Key, 10);

  unsigned char* plaintext = new unsigned char[256];
  int plaintext_len;


  // for (int m = 0; m < 32; m++) {
  //   key[m] = KEY[m];
  // }
  // bitset<8> y(key[0]);
  // cout << y << "\n";
  // bitset<8> x(key[1]);
  // cout << x << "\n";
  // cout << start << "\n";

  int i = 0;
  key[0] = start;
  key[1] = 0;
  key[2] = 0;
  key[3] = 0;
  key[4] = 0;

  for (i; i < 274877906944; i++) {

    plaintext_len = decrypt(key, plaintext);

    if(check_plaintext(plaintext, plaintext_len)) {
     cout << plaintext << "  " << plaintext_len <<"\n";

     bitset<8> x(key[0]);
     bitset<8> y(key[1]);
     bitset<8> z(key[2]);
     bitset<8> c(key[3]);
     bitset<8> d(key[4]);
     cout << x << y << z << c << d <<"\n";
  	}
		//key[4] = (i%16 << 4 | 3);
    key[4]++;

    if(i%256 == 0){
     key[3]++;
    }
    if(i % 65536 == 0){
     key[2]++;
    }
    if(i % 16777216 == 0){
      key[1]++;
    }
    if(i % 4294967296 == 0){
      key[0]++;
    }
  }
}
