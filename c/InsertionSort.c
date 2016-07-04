/* 插入排序 */

#include "stdio.h"

#define LEN 26

void InsertionSort(int arr[],int len){
  
  int i,j,tmp;

  for(i = 1; i < len; i++){
    tmp = arr[i];
    for(j = i; j>0 && arr[j-1]>tmp; j--){
      arr[j] = arr[j-1];
      arr[j-1] = tmp;
    }
  }
}

int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i;

  printf("array before sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  
  InsertionSort(arr,LEN);

  printf("\narray after sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]);
  }
  printf("\n");
}

