/* 堆排序 */

#include "stdio.h"

#define LEN 26

#define LeftChild(i)  (2*(i) + 1)

void Sink(int arr[],int i,int len){
  int child,tmp;

  for(tmp = arr[i]; LeftChild(i)<len; i=child){
    child = LeftChild(i);

    if( child != len-1 && arr[child+1] > arr[child]){
      child++;
    }

    if( tmp < arr[child] ){
      arr[i] = arr[child];
    }
    else{
      break;
    }
  }
  arr[i] = tmp;
}

void HeapSort(int arr[],int len){
  int i,tmp;
  for( i = len/2; i >= 0; i-- ){  // BuildHeap
    Sink( arr, i, len );
  }
  
  for( i = len - 1; i > 0; i-- ){
    tmp = arr[0];
    arr[0] = arr[i];
    arr[i] = tmp;
    Sink( arr, 0, i );
  }

}

int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i;

  printf("array before sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  printf("\n");
  
  HeapSort(arr,LEN);

  printf("\narray after sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]);
  }
  printf("\n");
}

